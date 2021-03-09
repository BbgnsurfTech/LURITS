<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance AS SAttendance;
use App\StudentAdmission;
use App\Classroom;
use App\Attendance;
use App\Atlas;
use App\User;
use Carbon\Carbon;
use App\Term;
use App\SchoolAtlas;
use App\School;
use App\Session;
use Validator;
use App\AtlasLink;
use Auth;
use App\DsClass;
use App\SchoolClass;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
        
    	$classroom = SchoolClass::with(["classTitle", "armTitle"])->where('school_id', Auth::User()->school_id)->get();
        
    	return view('admin.attendances.index', compact('classroom'));
    }

    public function get($school, $id)
    {
        //dd($school, $id);
    	$attendance = StudentAdmission::where('school_enrolled_id', $school)->where('class_id','=', $id)->get();
    	return json_encode($attendance);
    }

    public function gett($id)
    {
        //dd($school, $id);
        $attendance = StudentAdmission::where('school_enrolled_id', Auth::User()->school_id)->where('class_id','=', $id)->get();
        return json_encode($attendance);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        if ($request->student_id == null) {
            session()->flash('error', 'No student is enrolled in this class.');
            return redirect()->back();
        }

        $request->validate([
            'classs' => 'required',
            'date' => 'required'
        ]);

    	$term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
    	$classroom = $request->classs;
        if (Auth::User()->is_headTeacher || Auth::User()->is_teacher) {
            $school = Auth::User()->school_id;
        } else {
            $school = $request->school;
        }
        //dd($school);
        $a = Attendance::where('school_id', $school)->where('class_id', $request->classs)->where('date', $request->date)->get();
        //dd($a);
        if (!$a->isEmpty()) {
            session()->flash('error', 'Attendance has already been taken');
            return redirect()->back();
        }

        if ($request->date > Carbon::now()->format('Y/m/d')) {
            session()->flash('error', 'Your selected date is greater than today');
            return redirect()->back();
        }

        

   		foreach ($request->student_id as $id) {
            $data_id = Attendance::where('school_id', $school)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }

            $attendance = new Attendance();
            $attendance->id = $model_id;
            $attendance->admission_id = $id;
            $attendance->attendance_morning = $request->attendance_morning[$id];
            $attendance->attendance_afternoon = $request->attendance_afternoon[$id];
            $attendance->late_status = $request->late_status[$id];
            $attendance->note = $request->notes[$id];
            $attendance->class_id = $classroom;
            $attendance->date = $request->date;
            $attendance->session_id = $session_id[0]->id;
            $attendance->term_id = $term_id[0]->id;
            $attendance->school_id = $school;
            $attendance->save();
            // $data[]=[
            //     "id" => $model_id,
            //     "admission_id" => $id,
            //     "attendance_morning" => $request->attendance_morning[$id],
            //     "attendance_afternoon" => $request->attendance_afternoon[$id],
            //     "late_status" => $request->late_status[$id],
            //     "note" => $request->notes[$id],
            //     "class_id" => $classroom,
            //     "date" => $request->date,
            //     "session_id" => $session_id[0]->id,
            //     "term_id" => $term_id[0]->id,
            //     "school_id" => $school,
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),   
            // ];
        }
        // dd($data);
        // $attendance = Attendance::insert($data);

        session()->flash('message', 'Attendance data recorded successfully');
        return redirect()->back();
    }

    public function student_attendance(Request $request)
    {
        $attendance = [];
        $classrooms = Classroom::all();
		$class_id = $request->class_id;
		
		$date = $request->date;		
		if($class_id == ""  || $date == ""){
			return view('admin.attendances.create',compact('attendance','date','class_id', 'classrooms'));
		}else{		    
			$class = Classroom::find($class_id)->class;
			
			$classrooms = Classroom::all();
			$attendance = StudentAdmission::where('class_id','=',$class_id)->get();														                        

			return view('admin.attendances.create',compact('attendance','date','class','class_id','classrooms'));
		}
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function student_attendance_save(Request $request)
    {	
		
		$validator = Validator::make($request->all(), [
            'class_id' => 'required',
        ]);
        if ($validator->fails()) {
            
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('admin/attendances')
                            ->withErrors($validator)
                            ->withInput();
			}				
        }
		
        for ($i=0; $i < count($request->admission_id) ; $i++) {
			$temp = array();
			$temp['admission_id'] = (int)$request->admission_id[$i];
			$temp['class_id'] = (int)$request->class_id[$i];
			$temp['school_id'] = (int)$request->school_id[$i];
			$temp['attendance_morning'] = (int)$request->attendance_morning[$i];
			$temp['attendance_afternoon'] = (int)$request->attendance_afternoon[$i];
			$temp['late_status'] = (int)$request->late_status[$i];
			$temp['note'] = (string)$request->note[$i];
			$temp['date'] = $request->date;
			
			$studentAtt = SAttendance::firstOrNew($temp);
			$studentAtt->admission_id = $temp['admission_id'];
			$studentAtt->class_id = $temp['class_id'];
			$studentAtt->school_id = $temp['school_id'];
			$studentAtt->attendance_morning = $temp['attendance_morning'];
			$studentAtt->attendance_afternoon = $temp['attendance_afternoon'];
			$studentAtt->late_status = $temp['late_status'];
			$studentAtt->note = $temp['note'];
			$studentAtt->date = $temp['date'];
			
			$studentAtt->save();				
        }


		if(! $request->ajax()){
		   return redirect('admin/attendances')->with('success',('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>('Saved Sucessfully')]);
		}
        
    }

     
}
