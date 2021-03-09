<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Staff;
use App\Classroom;
use App\TeacherAttendance;
use App\Atlas;
use App\User;
use Carbon\Carbon;
use Validator;
use Auth;
use App\AtlasLink;
use App\Session;
use App\SchoolAtlas;
use App\School;
use App\Term;
use App\FaceVerification;
use App\Models\ClassSchedule;
use App\LessonAttendace;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.staff-attendance.create');
    }

    public function get($id)
    {
        $attendance = Staff::where('school_id','=',$id)->get();
        return json_encode($attendance);
    }

    public function gett()
    {
        $attendance = Staff::where('school_id', Auth::user()->school_id)->get();
        return json_encode($attendance);
    }

    public function face(Request $request)
    {
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        if (!Auth::User()->is_headTeacher) {
            $school_id = 1210110001;
        } else {
            $school_id = Auth::User()->school_id;
        }
        $api = $request->userApi;
        // dd($api);
        if ($api != null) {
        $a = FaceVerification::where('date', Carbon::now()->format('Y-m-d'))->where('api_id', $api)->get();
        if ($a->isEmpty()) {
            if ($request->ajax()) {
                $curl = curl_init();
                $url = "https://api.luxand.cloud/photo/verify/".$api;
                //dd($url);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => [ "photo" => curl_file_create($request->photo)], 
                    // or use URL
                    // CURLOPT_POSTFIELDS => [ "photo" => "https://dashboard.luxand.cloud/img/brad.jpg" ], 
                    CURLOPT_HTTPHEADER => array(
                        "token: 631dc0a781be4335997fb893b1d3de55"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return (419);
                } else {
                    $json = json_decode($response);
                    // dd($json);
                    if ($json->status == "success") {
                        $data_id = FaceVerification::where('school_id', $school_id)->max('id') + 1;
                        // dd($data_id);
                        if ($data_id == 1) {
                            $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
                        } else {
                            $model_id = $data_id;
                        }

                        $a = new FaceVerification();
                        $a->id = $model_id;
                        $a->date = Carbon::now()->format('Y-m-d');
                        $a->api_id = $api;
                        $a->term_id = $term_id[0]->id;
                        $a->session_id = $session_id[0]->id;
                        $a->school_id = $school_id;
                        $a->attendance_status = "Present";
                        $a->save();
                        
                        return (200);
                        
                    } elseif ($json->status == "failure") {
                        return (405);
                    }
                }
            }
        } else {
            return (404);
        }
    } else {
        return (401);
    }
    }

    public function verify(Request $request, $id)
    {
        // dd($id);
        if ($id != "null"){
        if($request->ajax()){
            $a = FaceVerification::where('date', Carbon::now()->format('Y-m-d'))->where('api_id', $id)->get();
            if ($a->isEmpty()) {
                $message = 200;
                return json_encode($message);
            } else {
                $message = 404;
                return json_encode($message);
            }
        } else {
            abort(404);
        }
    } else {
        $message = 401;
        return json_encode($message);
    }
    }

    public function save(Request $request)
    {
        $request->validate([
            'date' => "required",
        ]);

        if ($request->student_id < 1) {
            session()->flash('message', 'Staff Attendace is required');
        }

        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }
        
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();

        $date = TeacherAttendance::where('school_id', $school_id)->where('date', $request->date)->first();

        if ($date != '') {
            session()->flash('error', 'Attendace has been taken for the selected date');
            return redirect()->back();
        }

        if ($request->date > Carbon::now()->format('Y/m/d')) {
            session()->flash('error', 'The selected date is greater than today');
            return redirect()->back();
        }
        
        foreach ($request->student_id as $id) {
            $data_id = TeacherAttendance::where('school_id', $school_id)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }
            // dd($model_id);

            $attendance = new TeacherAttendance();
            $attendance->id = $model_id;
            $attendance->staff_id = $id;
            $attendance->attendance_status_morninig = $request->attendance_status_morning[$id];
            $attendance->attendance_status_afternoon = $request->attendance_status_afternoon[$id];
            $attendance->late_status_y_n = $request->late_status_y_n[$id];
            $attendance->note = $request->notes[$id];
            $attendance->date = $request->date;
            $attendance->session_id = $session_id[0]->id;
            $attendance->term_id = $term_id[0]->id;
            $attendance->school_id = $school_id;
            $final = $attendance->save();
            // $data[]=[
            //     "staff_id" => $id,
            //     "attendance_status_morninig" => $request->attendance_status_morning[$id],
            //     "attendance_status_afternoon" => $request->attendance_status_afternoon[$id],
            //     "late_status_y_n" => $request->late_status_y_n[$id],
            //     "note" => $request->notes[$id],
            //     "date" => $request->date,
            //     "school_id" => $school_id,
            //     "term_id" => $term_id[0]->id,
            //     "session_id" => $session_id[0]->id,
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),   
            // ];
            //dd($data);
        }

        if ($final) {
            session()->flash('message', 'Staff Attendace Recorded Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Operation Successful');
            return redirect()->back();
        }
    }

    //LESSON VERIFICATION

    public function lesson(Request $request)
    {
        if ($request->ajax()) {
            $data = ClassSchedule::where('school_id', Auth::user()->school_id)->with(["staff"])->get();
            //dd($data);
            $attendance = Staff::whereIn('id', $data)->get();
            return json_encode($data);
        }

        return view('admin.attendances.lesson');
    }

    public function vLesson(Request $request, $id)
    {
        if($request->ajax()){
            $staff = Staff::where('api_id', $id)->pluck('id')->first();

            $a = LessonAttendace::where('staff_id', $staff)->where('date', Carbon::now()->format('Y-m-d'))->get();
            if ($a->isEmpty()) {
                $message = 200;
                return json_encode($message);
            } else {
                $message = 404;
                return json_encode($message);
            }
        } else {
            abort(404);
        }
    }

    public function confirm(Request $request)
    {
        // dd($request->all());
        $api = $request->userApi;
        $staff = Staff::where('api_id', $api)->pluck('id')->first();

        $a = LessonAttendace::where('staff_id', $staff)->where('date', Carbon::now()->format('Y-m-d'))->get();
        if ($a->isEmpty()) {
            if ($request->ajax()) {
                $curl = curl_init();
                $url = "https://api.luxand.cloud/photo/verify/".$api;
                //dd($url);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => [ "photo" => curl_file_create($request->photo)], 
                    // or use URL
                    // CURLOPT_POSTFIELDS => [ "photo" => "https://dashboard.luxand.cloud/img/brad.jpg" ], 
                    CURLOPT_HTTPHEADER => array(
                        "token: 631dc0a781be4335997fb893b1d3de55"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return (419);
                } else {
                    $json = json_decode($response);
                    if ($json->status == "success") {

                        $a = new LessonAttendace();
                        $a->date = Carbon::now()->format('Y-m-d');
                        $a->staff_id = $staff;
                        $a->time_in = Carbon::now()->format('H-m-s');
                        $a->save();
                        
                        return (200);
                        
                    } elseif ($json->status == "failure") {
                        return (405);
                    }
                }
            }
        } else {
            return (404);
        }
    }
}
