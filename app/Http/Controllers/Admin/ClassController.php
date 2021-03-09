<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Redirect;
use Response;
use App\SchoolClass;
use Gate;
use Symfony\Component\HttpFoundation\Response as Responsee;
use App\DsClass;
use App\DsArms;
use App\SchoolAtlas;
use App\School;
use App\DsClassSector;

class ClassController extends Controller
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
        abort_if(Gate::denies('manage_classes_access'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');
        
        if (Auth::User()->is_superAdmin) {
            
        } else if (Auth::User()->is_lgea) {
            $class_sector = DsClassSector::where('sector_id', 1)->pluck('class_id');
            $classrooms = SchoolClass::where('school_id', $request->schooll)->with(["classTitle", "armTitle", "staffData"])->latest()->get();
            $a = Auth::User()->atlas;
                    $b = $a->atlas_id;
                    $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
                    $schools = School::whereIn('id', $schooll)->where('code_type_sector', 1)->get();
        } else {
            $class_sector = DsClassSector::where('sector_id', Auth::User()->school->code_type_sector)->pluck('class_id');
            $classrooms = SchoolClass::where('school_id', Auth::User()->school_id)->with(["classTitle", "armTitle", "staffData"])->latest()->get();
            $schools = null;
        }
        
        $classes = DsClass::whereIn('id', $class_sector)->get();
        $arms = DsArms::all();
        $teachers = Staff::where('school_id', Auth::User()->school_id)->get();
        //dd($teachers);
        //dd(Auth::guard('staff')->user()->school_id);
        if ($request->ajax()) {
            return Datatables::of($classrooms)
                ->addIndexColumn()
                ->addColumn('actions', 'admin.pages.lessonmanagement.classroomactions')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.pages.lessonmanagement.manageclassrooms', compact('classes', 'arms', 'teachers', 'schools'));
    }
    
    public function getTeachers(Request $request)
    {
        $teachers = Staff::where('school_id', $request->school_idd)->get();
        return response($teachers);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('manage_classes_store'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'class_id' => 'required',
            'arm_id' => 'required',
            'teacher' => 'required',
        ]);

        if (Auth::User()->is_headTeacher) {
            $school_id= Auth::User()->school_id;
        } else {
            $school_id= $request->school;
        }

        $data_id = SchoolClass::where('school_id', $school_id)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        if ($request->class_idd == null) {
            $data = new SchoolClass();
            $data->id = $model_id;
            $data->ds_class_id = $request->class_id;
            $data->ds_arm_id = $request->arm_id;
            $data->school_id = $school_id;
            $data->staff_id = $request->teacher;
            $final = $data->save();

            if($final){
                $notification = array(
                    'message' => 'School Class Added Successfully'
                );
                return redirect()->route('admin.classes.index')->with($notification);
            }
            else{
                $notification = array(
                    'message' => 'Operation Failed'
                );
                return redirect()->back()->with($notification);
            }
            return Response::json(['type' => 'success', 'message' => $msg]);
        } else {
            $data = SchoolClass::find($request->class_idd);
            $data->ds_class_id = $request->class_id;
            $data->ds_arm_id = $request->arm_id;
            $data->school_id = $school_id;
            $data->staff_id = $request->teacher;
            $final = $data->save();

            if($final){
                $msg = 'Class data updated successfully.';
            }
            else{
                $msg = 'Something went wrong';
            }
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
        abort_if(Gate::denies('manage_classes_edit'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');
        $class = SchoolClass::where('id', $id)->with(["classTitle", "armTitle"])->first();
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
        abort_if(Gate::denies('manage_classes_destroy'), Responsee::HTTP_FORBIDDEN, '403 Forbidden');
        $class = SchoolClass::where('id',$id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);
    }
}
