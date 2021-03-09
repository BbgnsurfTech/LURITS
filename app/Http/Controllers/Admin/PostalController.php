<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPostalRequest;
use App\Http\Requests\StorePostalRequest;
use App\Http\Requests\UpdatePostalRequest;
use App\Postal;
use App\Atlas;
use App\Team;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class PostalController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('postal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       if ($request->ajax()) {
            $query = Postal::where('team_id', $request->school)->select(sprintf('%s.*', (new Postal)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'postal_show';
                $editGate      = 'postal_edit';
                $deleteGate    = 'postal_delete';
                $crudRoutePart = 'postal';

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
            $table->addColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->addColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
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
        
        return view('admin.postal.index', compact('country_list'));
    }

    public function store(StorePostalRequest $request)
    {
        abort_if(Gate::denies('postal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $postal = Postal::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new Postal();
        $data->date = $request->date;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->address = $request->address;
        $data->notes = $request->notes;
        $data->remark = $request->remark;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.postal.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.postal.index');
    }

    public function edit(Postal $postal)
    {
        abort_if(Gate::denies('postal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postal.edit', compact('postal'));
    }

    public function update(UpdatePostalRequest $request, Postal $postal)
    {
        // $postal->update($request->all());

        $data = Postal::find($postal->id);
        $data->date = $request->date;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->address = $request->address;
        $data->notes = $request->notes;
        $data->remark = $request->remark;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.postal.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.postal.index');
    }

    public function show(Postal $postal)
    {
        abort_if(Gate::denies('postal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postal.show', compact('postal'));
    }

    public function destroy(Postal $postal)
    {
        abort_if(Gate::denies('postal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postal->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostalRequest $request)
    {
        Postal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
