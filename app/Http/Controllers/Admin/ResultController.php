<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyResultRequest;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Classroom;
use App\DsSubject;
use App\StudentAdmission;
use App\Result;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Atlas;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class ResultController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            
            $query = Result::where('class_id', $request->classs)->select(sprintf('%s.*', (new Result)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'result_show';
                $editGate      = 'result_edit';
                $deleteGate    = 'result_delete';
                $crudRoutePart = 'result';

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
            $table->editColumn('student_id', function ($row) {
                return $row->student_id ? $row->student_id : "";
            });
            $table->editColumn('first_ca', function ($row) {
                return $row->first_ca ? $row->first_ca : "";
            });
            $table->editColumn('second_ca', function ($row) {
                return $row->second_ca ? $row->second_ca : "";
            });
            $table->editColumn('exam', function ($row) {
                return $row->exam ? $row->exam : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.result.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');        

        $classroom = Classroom::all();

        $subject = DsSubject::all();

        $studentAdmission = StudentAdmission::all();

        return view('admin.result.create', compact('classroom', 'studentAdmission', 'subject'));
    }

    public function store(StoreResultRequest $request)
    {
        // $result = Result::create($request->all());   
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();     

        $team_id = Auth::User()->team_id;

        $data = new Result();
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->class_id = $request->class_id;
        $data->subject = $request->subject;
        $data->first_ca = $request->first_ca;
        $data->second_ca = $request->second_ca;
        $data->exam = $request->exam;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.result.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.result.index');
    }

    public function edit(Result $result)
    {
        abort_if(Gate::denies('result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom = Classroom::all();

        $studentAdmission = StudentAdmission::all();

        $subject = DsSubject::all();        

        //$result->load('subject', 'classroom');
        //dd($result);

        return view('admin.result.edit', compact('classroom', 'subject', 'studentAdmission', 'result'));
    }

    public function update(UpdateResultRequest $request, Result $result)
    {
        // $result->update($request->all());        

        $data = Result::find($result->id);
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->class_id = $request->class_id;
        $data->subject = $request->subject;
        $data->first_ca = $request->first_ca;
        $data->second_ca = $request->second_ca;
        $data->exam = $request->exam;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.result.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.result.index');
    }

    public function show(Result $result)
    {
        abort_if(Gate::denies('result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$result->load('subject', 'classroom');

        $classroom = Classroom::all()->pluck('class', 'id');

        return view('admin.result.show', compact('result', 'classroom'));
    }

    public function destroy(Result $result)
    {
        abort_if(Gate::denies('result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $result->delete();

        return back();
    }

    public function massDestroy(MassResultRequest $request)
    {
        Result::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
