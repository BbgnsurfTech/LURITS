<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Staff\Staff;
use App\Models\SubjectSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Redirect;
use Response;

class SubjectSettingController extends Controller
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
        $subjectsettings = SubjectSetting::latest()->where('school_id', Auth::user()->school_id)->get();
        //dd(Auth::guard('staff')->user()->school_id);
        if ($request->ajax()) {
            return Datatables::of($subjectsettings)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return DsSubject::find($row->subject_id)?DsSubject::find($row->subject_id)->name:"";
                })
                ->addColumn('actions', 'admin.pages.lessonmanagement.subjectsettingactions')
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('admin.pages.lessonmanagement.managesubjectsettings', compact('subjectsettings'));
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
            'subjectsetting' => 'required',
             ]);

        if ($validator->fails()) {
            return response()->json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
        }else{
            $subjectsetting_id = $request->subjectsetting_id;
            SubjectSetting::updateOrCreate(
                ['id' => $subjectsetting_id],
                [
                    'subject_id' => $request->subjectsetting,
                    'school_id' => Auth::user()->school_id
                 ]
            );
            if(empty($request->subjectsetting_id))
                $msg = 'Subject Setting created successfully.';
            else
                $msg = 'Subject Setting data is updated successfully';
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
        $subjectsetting = SubjectSetting::where($where)->first();
        return Response::json($subjectsetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subjectsetting = SubjectSetting::where('id',$id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);
    }
}

