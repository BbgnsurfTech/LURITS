<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySubjectsRequest;
use App\Http\Requests\StoreSubjectsRequest;
use App\Http\Requests\UpdateSubjectsRequest;
use App\DsSubject;
use App\School;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Atlas;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Classroom;

class SubjectsController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            
            $query = DsSubject::where('class_id', $request->classs)->select(sprintf('%s.*', (new Subject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'subject_show';
                $editGate      = 'subject_edit';
                $deleteGate    = 'subject_delete';
                $crudRoutePart = 'subjects';

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
            $table->editColumn('ds_subject_name', function ($row) {
                return $row->ds_subject_name ? $row->ds_subject_name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }       

        $classroom = Classroom::where('school_id', Auth::User()->school_id)->get();

        $school = Auth::User()->schools()->get();

        return view('admin.subjects.index', compact('classroom', 'school'));
    }

    public function getSubject(Request $request)
    {
       abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            
            $query = DsSubject::where('class_id', $request->classs)->select(sprintf('%s.*', (new Subject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'subject_show';
                $editGate      = 'subject_edit';
                $deleteGate    = 'subject_delete';
                $crudRoutePart = 'subjects';

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
            $table->editColumn('ds_subject_name', function ($row) {
                return $row->ds_subject_name ? $row->ds_subject_name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }       

        $admin = Auth::User()->roles()->pluck('id');
        
        if ($admin[0] == 1) {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }

        return view('admin.subjects.index', compact('isAdmin'));
    }

    public function store(StoreSubjectsRequest $request)
    {
        abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$subjects = DsSubject::create($request->all());

        $user_id = Auth::User()->school_id;

        $data = new Subject();
        $data->ds_subject_name = $request->ds_subject_name;
        $data->class_id = $request->class_id;
        $data->school_id = $user_id; 
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.subjects.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        //return redirect()->route('admin.subjects.index');
    }

    public function edit(Subject $subject)
    {
        if ($subject->school_id !== Auth::User()->school_id) {
            abort(404);
        } else {
        abort_if(Gate::denies('subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');       

        $classroom = Classroom::all();
       // $subjects = DsSubject::all();
       // dd($subjects);

        return view('admin.subjects.edit', compact('subject', 'classroom'));
        }
        
    }

    public function update(UpdateSubjectsRequest $request, Subject $subject)
    {
        //$subject->update($request->all());
        $data = DsSubject::find($subject->id);
        $data->ds_subject_name = $request->ds_subject_name;
        $data->class_id = $request->class_id;
        //dd($data);
        $result = $data->update();
        if ($result) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.subjects.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        //return redirect()->route('admin.subjects.index');
    }

    public function show(Subject $subject)
    {
        abort_if(Gate::denies('subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $subjects = DsSubject::find($subjects);
       // dd($subject);

        return view('admin.subjects.show', compact('subject'));
    }

    public function destroy(Subject $subject)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject->delete();

        return back();
    }

    public function massDestroy(MassDestroySubjectsRequest $request)
    {
        DsSubject::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
