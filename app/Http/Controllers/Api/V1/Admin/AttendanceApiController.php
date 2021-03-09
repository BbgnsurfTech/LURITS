<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\Admin\AttendanceResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class AttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceResource(Attendance::with(['admission', 'school'])->get());
    }

    // public function store(StoreAttendanceRequest $request)
    // {
    //     $attendance = Attendance::create($request->all());

    //     return (new AttendanceResource($attendance))
    //         ->response()
    //         ->setStatusCode(Response::HTTP_CREATED);
    // }
     public function store(Request $request)
    {
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $allAttendanceData = $request->all();
        // dd($allAttendanceData);
        
        DB::beginTransaction();
        try {
            foreach ($allAttendanceData['attendance'] as $allData) {
                if ($allData['attendance_id'] == '') {
                    $data = new Attendance();
                    $attendance = true;
                } else {
                    $data = Attendance::where('school_id', $allData['school_id'])->where('admission_id', $allData['admission_id'])->where('id', $allData['attendance_id'])->where('class_id', $allData['class_id'])->where('date', $allData['date'])->where('term_id', $allData['ds_term_id'])->where('session_id', $allData['ds_year_session_id'])->first();
                    $attendance = false;
                }
                // dd($allData['school_id']);
                
                $data->school_id = $allData['school_id'];
                $data->admission_id = $allData['admission_id'];
                $data->class_id = $allData['class_id'];
                $data->session_id = $allData['ds_year_session_id'];
                $data->term_id = $allData['ds_term_id'];
                $data->date = $allData['date'];
                $data->attendance_status_morning = $allData['attendance_status_morning'];
                $data->attendance_status_afternoon = $allData['attendance_status_afternoon'];
                $data->late_status_y_n = $allData['late_status_y_n'];
                if ($allData['attendance_id'] == '') {
                    // $data->id = $allData['school_id'];
                    $data->save();
                } else {
                    $data->update();
                }
                }           
            $studentAttendanceData = DB::table('attendances')->join('student_admissions','attendances.admission_id','=','student_admissions.id')->select('attendances.*', 'student_admissions.admission_number', 'student_admissions.child_name','student_admissions.middle_name','student_admissions.last_name')->where('attendances.school_id', $allData['school_id'])->where('attendances.date', $allAttendanceData['attendance_date'])->where('attendances.term_id', $allData['ds_term_id'])->where('attendances.session_id', $allData['ds_year_session_id'])->get();
            // dd($studentAttendanceData);

            DB::commit();
            $msg = [
                'studentAttendanceNew' => $attendance,
                'attendance_date'=> $allAttendanceData['attendance_date'],
                'statistics' => $allAttendanceData['statistics'],
                'attendance' => $studentAttendanceData
            ];
        } catch (\Exception $e) {
            DB::rollback();
            $msg = $e;
        }

        return response($msg);
    }

    public function show(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceResource($attendance->load(['admission', 'school']));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return (new AttendanceResource($attendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $a = Attendance::where('date', $request['attendance_date'])->where('school_id', $request['attendance'][0]['school_id'])->where('class_id', $request['attendance'][0]['class_id'])->where('term_id', $request['attendance'][0]['ds_term_id'])->where('session_id', $request['attendance'][0]['ds_year_session_id'])->delete();  
        return response(null, Response::HTTP_NO_CONTENT);
    }

    // public function destroy(Attendance $attendance)
    // {
    //     abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $attendance->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
