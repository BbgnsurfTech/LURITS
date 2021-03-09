<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySdbRequest;
use App\Http\Requests\StoreSdbRequest;
use App\Http\Requests\UpdateSdbRequest;
use App\Teacher;
use App\Sdb;
use Gate;
use App\Term;
use App\Session;
use App\Atlas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class SdbController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('sdb_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sdb::where('team_id', $request->school)->select(sprintf('%s.*', (new Sdb)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sdb_show';
                $editGate      = 'sdb_edit';
                $deleteGate    = 'sdb_delete';
                $crudRoutePart = 'sdb';

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
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });
            $table->addColumn('offence', function ($row) {
                return $row->offence ? $row->offence : '';
            });
            $table->editColumn('response', function ($row) {
                return $row->response ? $row->response : "";
            });
            $table->editColumn('disciplinary_action', function ($row) {
                return $row->disciplinary_action ? $row->disciplinary_action : "";
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.sdb.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('sdb_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffs = Teacher::all();

        return view('admin.sdb.create', compact('staffs'));
    }

    public function store(StoreSdbRequest $request)
    {
        // $sbd = Sdb::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new Sdb();
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->rank = $request->rank;
        $data->offence = $request->offence;
        $data->response = $request->response;
        $data->number_of_offence = $request->number_of_offence;
        $data->disciplinary_action = $request->disciplinary_action;
        $data->punished_by = $punished_by;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $data->remark = $remark;
        $data->team_id = $team_id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.sdb.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.sdb.index');
    }

    public function edit(Sdb $sdb)
    {
        abort_if(Gate::denies('sdb_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $staffs = Teacher::all();        
        
        return view('admin.sdb.edit', compact('staffs', 'sdb'));
    }

    public function update(UpdateSdbRequest $request, Sdb $sdb)
    {
        // $sdb->update($request->all());

        $data = Sdb::find($sdb->id);
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->rank = $request->rank;
        $data->offence = $request->offence;
        $data->response = $request->response;
        $data->number_of_offence = $request->number_of_offence;
        $data->disciplinary_action = $request->disciplinary_action;
        $data->punished_by = $punished_by;
        $data->remark = $remark;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.sdb.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.sdb.index');
    }

    public function show(Sdb $sdb)
    {
        abort_if(Gate::denies('sdb_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sdb.show', compact('sdb'));
    }

    public function destroy(Sdb $sdb)
    {
        abort_if(Gate::denies('sdb_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sdb->delete();

        return back();
    }

    public function massDestroy(MassDestroySdbRequest $request)
    {
        Sdb::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
