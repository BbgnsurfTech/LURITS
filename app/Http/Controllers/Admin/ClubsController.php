<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClubsRequest;
use App\Http\Requests\StoreClubsRequest;
use App\Http\Requests\UpdateClubsRequest;
use App\Club;
use App\Atlas;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class ClubsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('clubs_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = Club::where('team_id', $request->school)->select(sprintf('%s.*', (new Club)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'assignment_show';
                $editGate      = 'assignment_edit';
                $deleteGate    = 'assignment_delete';
                $crudRoutePart = 'assignment';

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
            $table->editColumn('term', function ($row) {
                return $row->term ? $row->term : "";
            });
            $table->editColumn('week', function ($row) {
                return $row->week ? $row->week : "";
            });
            $table->editColumn('topic', function ($row) {
                return $row->topic ? $row->topic : "";
            });
            $table->editColumn('assignment', function ($row) {
                return $row->assignment ? $row->assignment : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
            
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.clubs.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('clubs_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clubs.create');
    }

    public function store(StoreClubsRequest $request)
    {
        //$club = Club::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new Club();
        $data->date = $request->date;
        $data->name = $request->name;
        $data->purpose = $request->purpose;
        $data->venue = $request->venue;
        $data->remark = $request->remark;
        $data->duration = $request->duration;
        $data->activity = $request->activity;
        $data->participants = $request->participants;
        $data->resolution = $request->resolution;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.clubs.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        //return redirect()->route('admin.clubs.index');
    }

    public function edit(Club $club)
    {
        abort_if(Gate::denies('clubs_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clubs.edit', compact('club'));
    }

    public function update(UpdateClubsRequest $request, Club $club)
    {
        // $club->update($request->all());

        $data = Club::find($club->id);
        $data->date = $request->date;
        $data->name = $request->name;
        $data->purpose = $request->purpose;
        $data->venue = $request->venue;
        $data->remark = $request->remark;
        $data->duration = $request->duration;
        $data->activity = $request->activity;
        $data->participants = $request->participants;
        $data->resolution = $request->resolution;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.clubs.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.clubs.index');
    }

    public function show(Club $club)
    {
        abort_if(Gate::denies('clubs_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clubs.show', compact('club'));
    }

    public function destroy(Club $club)
    {
        abort_if(Gate::denies('clubs_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->delete();

        return back();
    }

    public function massDestroy(MassDestroyClubsRequest $request)
    {
        Club::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
