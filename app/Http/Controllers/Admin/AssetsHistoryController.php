<?php

namespace App\Http\Controllers\Admin;

use App\AssetsHistory;
use App\Atlas;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetsHistoryController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistories = AssetsHistory::all();
        if ($request->ajax()) {

            $query = AssetsHistory::where('school_id', $request->school)->select(sprintf('%s.*', (new AssetsHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'assets_history_show';
                $editGate      = 'assets_history_edit';
                $deleteGate    = 'assets_history_delete';
                $crudRoutePart = 'assets-histories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('asset_id', function ($row) {
                return $row->asset_id ? $row->asset_id : "";
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
            
        }

        return view('admin.assetsHistories.index', compact('assetsHistories'));
    }
}
