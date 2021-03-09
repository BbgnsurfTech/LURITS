<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Classroom;
use App\StudentAdmission;

class PagesController extends Controller
{
    public function index(Request $request){
    $attendance = [];
		$class_id = Classroom::all();
		
		$date = $request->date;		
		if($class_id == ""  || $date == ""){
			return view('admin.page.attendance_view',compact('attendance','date','class_id'));
		}else{		    
			$class = Classroom::find('class');
			

			$attendance = StudentAdmission::select('*','ds_attendance.id AS attendance_id')
									->leftJoin('ds_attendance',function($join) use ($date) {
										$join->on('ds_attendance.admission_id','=','student_admissions.id');
										$join->where('ds_attendance.class_id','=',$date);
									})
									
									->get();														                        

			return view('admin.page.attendance_view',compact('attendance','date','class','class_id','section_id'));
		}
    }


  public function getUsers($class_id = 0){
    // Fetch all records
    $userData['data'] = Page::getuserData($class_id);

    echo json_encode($userData);
    exit;
  }
}
