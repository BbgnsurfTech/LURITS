<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Response;
use Gate;
use App\SchoolClass;
use App\DsSubjectSector;
use App\DsSubject;
use Symfony\Component\HttpFoundation\Response as Responsee;
use Auth;
use App\SchoolSubject;
use App\SchoolAtlas;
use App\School;

class SubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('manage_subjects_access'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');
        $subject = DsSubjectSector::where('sector_id', Auth::User()->school->pluck('code_type_sector'))->pluck('subject_id');
            $subjects = DsSubject::whereIn('id', $subject)->get();

            $classes = SchoolClass::with(["classTitle", "armTitle"])->where('school_id', Auth::User()->school_id)->get();

            $school_subject = SchoolDsSubject::where('school_id', Auth::User()->school_id)->with(["subjectName", "className.classTitle", "className.armTitle"])->get();

        if ($request->ajax()) {
            return Datatables::of($school_subject)
                ->addIndexColumn()
                ->addColumn('actions', 'admin.pages.lessonmanagement.subjectactions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.pages.lessonmanagement.managesubjects', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('manage_subjects_store'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');

        $validator = Validator::make($request->all(), [
            'class_id' => 'required',
            'subject' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
        } else {
            $school_id = Auth::User()->school_id;

            $data_id = SchoolDsSubject::where('school_id', $school)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }

            if ($request->subject_id == null) {
                $data = new SchoolSubject();
                $data->id = $model_id;
                $data->class_id = $request->class_id;
                $data->subject_id = $request->subject;
                $data->school_id = $school_id;
                $final = $data->save();

                if($final){
                    $msg = 'Class created successfully.';
                }
                else{
                    $msg = 'Something went wrong';
                }
                return Response::json(['type' => 'success', 'message' => $msg]);
            } else {
                $data = SchoolDsSubject::find($request->subject_id);
                $data->class_id = $request->class_id;
                $data->subject_id = $request->subject;
                $final = $data->update();

                if($final){
                    $msg = 'Class data updated successfully.';
                }
                else{
                    $msg = 'Something went wrong';
                }
                return Response::json(['type' => 'success', 'message' => $msg]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('manage_subjects_edit'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');

        $where = array('id' => $id);
        $subject = SchoolDsSubject::where('school_id', Auth::User()->school_id)->where($where)->with(["subjectName", "className.classTitle", "className.armTitle"])->first();
        return Response::json($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('manage_subjects_delete'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');

        $subject = SchoolDsSubject::where('id', $id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);

    }
}
