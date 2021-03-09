<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\ClassSetting;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Redirect;
use Response;

class SectionController extends Controller
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
        $sections = Section::latest()->where('school_id', Auth::user()->school_id)->get();

        if ($request->ajax()) {
            return Datatables::of($sections)
                ->addIndexColumn()
                ->addColumn('class', function($row){
                    return ClassSetting::find($row->class_id)?ClassSetting::find($row->class_id)->class->name:"";
                })
                ->addColumn('teacher', function($row){
                    return Staff::find($row->staff_id)?Staff::find($row->staff_id)->full_name:"";
                })
                ->addColumn('actions', 'admin.pages.lessonmanagement.sectionactions')
                ->rawColumns(['actions', 'class', 'teacher'])
                ->make(true);
        }
        return view('admin.pages.lessonmanagement.managesections', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'class' => 'required',
            'sectionteacher' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
        }else{
            $section_id = $request->section_id;
            $school_id = Auth::guard('staff')->user()->school_id;
            Section::updateOrCreate(['id' => $section_id],
                [
                    'name' => $request->name,
                    'title' => $request->title,
                    'class_id' => $request->class,
                    'staff_id' => $request->sectionteacher,
                    'school_id' => $school_id
                ]);
            if(empty($request->section_id))
                $msg = 'Section created successfully.';
            else
                $msg = 'Section data is updated successfully';

            return Response::json(['type' => 'success', 'message' => $msg]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $section = Section::where($where)->first();
        return Response::json($section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::where('id',$id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);

    }
}
