<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssignmentRequest;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Teacher;
use App\Assignment;
use App\Atlas;
use App\DsSubject;
use App\Classroom;
use Gate;
use App\Term;
use App\Session;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class AssignmentController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('assignment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = Assignment::where('team_id', $request->school)->select(sprintf('%s.*', (new Assignment)->table));
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

        return view('admin.assignment.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('assignment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignment = Assignment::all();        
        $staffs = Teacher::all();
        $subjects = DsSubject::all();
        $classroom = Classroom::all();

        return view('admin.assignment.create', compact('assignment', 'staffs', 'subjects', 'classroom'));
    }

    public function store(StoreAssignmentRequest $request)
    {
        // $assignment = Assignment::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $user_id = Auth::User()->team_id;

        $data = new Assignment();
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->term = $request->term;
        $data->week = $request->week;
        $data->class_id = $request->class_id;
        $data->subject = $request->subject;
        $data->topic = $request->topic;
        $data->assignment = $request->assignment;
        $data->remark = $request->remark;
        $data->team_id = $user_id; 
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.assignment.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.assignment.index');
    }

    public function edit(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $staffs = Teacher::all();     
        $subjects = DsSubject::all();   
        $classroom = Classroom::all();
        
        return view('admin.assignment.edit', compact('staffs', 'assignment', 'classroom', 'subjects'));
    }

    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        // $assignment->update($request->all());

        $data = Assignment::find($assignment->id);
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->term = $request->term;
        $data->week = $request->week;
        $data->class_id = $request->class_id;
        $data->subject = $request->subject;
        $data->topic = $request->topic;
        $data->assignment = $request->assignment;
        $data->remark = $request->remark;
        $result = $data->update();
        if ($result) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.assignment.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.assignment.index');
    }

    public function show(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assignment.show', compact('assignment', 'staff'));
    }

    public function destroy(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignmentRequest $request)
    {
        Assignment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
