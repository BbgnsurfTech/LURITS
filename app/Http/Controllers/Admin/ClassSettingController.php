<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Staff\Staff;
use App\Models\ClassSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Redirect;
use Response;

class ClassSettingController extends Controller
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
        $classsettings = ClassSetting::latest()->where('school_id', Auth::User()->school_id)->get();
        //dd(Auth::guard('staff')->user()->school_id);
        if ($request->ajax()) {
            return Datatables::of($classsettings)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return ClassRoom::find($row->class_id)?ClassRoom::find($row->class_id)->name:"";
                })
                ->addColumn('actions', 'admin.pages.lessonmanagement.classroomactions')
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('admin.pages.lessonmanagement.manageclasssettings', compact('classsettings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'class' => 'required',
             ]);

        if ($validator->fails()) {
            return response()->json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
        }else{
            $class_id = $request->class_id;
            ClassSetting::updateOrCreate(
                ['id' => $class_id],
                [
                    'class_id' => $request->class,
                    'school_id' => Auth::user()->school_id
                 ]
            );
            if(empty($request->class_id))
                $msg = 'Class Setting created successfully.';
            else
                $msg = 'Class Setting data is updated successfully';
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
        $class = ClassSetting::where($where)->first();
        return Response::json($class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = ClassSetting::where('id',$id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);
    }
}

