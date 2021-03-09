<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherAttendanceRequest;
use App\Http\Requests\UpdateTeacherAttendanceRequest;
use App\Http\Resources\Admin\TeacherAttendanceResource;
use App\TeacherAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Carbon\Carbon;

class StaffAttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherAttendanceResource(TeacherAttendance::with(['admission', 'school'])->get());
    }

    // public function store(StoreTeacherAttendanceRequest $request)
    // {
    //     $teacherAttendance = TeacherAttendance::create($request->all());

    //     return (new TeacherAttendanceResource($teacherAttendance))
    //         ->response()
    //         ->setStatusCode(Response::HTTP_CREATED);
    // }
    public function store(Request $request)
    {
        abort_if(Gate::denies('staff_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $allAttendanceData = $request->all();
        // dd($allAttendanceData);
        
        DB::beginTransaction();
        try {
            foreach ($allAttendanceData['attendance'] as $allData) {
                if ($allData['attendance_id'] == '') {
                    $data = new TeacherAttendance();
                    $attendance = true;
                } else {
                    $data = TeacherAttendance::where('school_id', $allData['school_id'])->where('staff_id', $allData['staff_id'])->where('id', $allData['attendance_id'])->where('date', $allData['date'])->where('term_id', $allData['ds_term_id'])->where('session_id', $allData['ds_year_session_id'])->first();
                    $attendance = false;
                }
                // dd($allData['school_id']);
                
                $data->school_id = $allData['school_id'];
                $data->staff_id = $allData['staff_id'];
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
            $staffAttendanceData = DB::table('staff_attendances')->join('staffs','staff_attendances.staff_id','=','staffs.id')->select('staff_attendances.*', 'staffs.lga_staff_id', 'staffs.first_name','staffs.middle_name','staffs.last_name')->where('staff_attendances.school_id', $allData['school_id'])->where('staff_attendances.date', $allAttendanceData['attendance_date'])->where('staff_attendances.term_id', $allData['ds_term_id'])->where('staff_attendances.session_id', $allData['ds_year_session_id'])->get();
            // dd($staffAttendanceData);

            DB::commit();
            $msg = [
                'staffAttendanceNew' => $attendance,
                'attendance_date'=> $allAttendanceData['attendance_date'],
                'statistics' => $allAttendanceData['statistics'],
                'attendance' => $staffAttendanceData
            ];
        } catch (\Exception $e) {
            DB::rollback();
            $msg = $e;
        }

        return response($msg);
    }

    public function show(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('staff_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherAttendanceResource($teacherAttendance->load(['admission', 'school']));
    }

    public function update(UpdateTeacherAttendanceRequest $request, TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->update($request->all());

        return (new TeacherAttendanceResource($teacherAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
    public function destroy(Request $request)
    {
        abort_if(Gate::denies('staff_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $a = TeacherAttendance::where('date', $request['attendance_date'])->where('school_id', $request['attendance'][0]['school_id'])->where('term_id', $request['attendance'][0]['ds_term_id'])->where('session_id', $request['attendance'][0]['ds_year_session_id'])->delete();  
        return response(null, Response::HTTP_NO_CONTENT);
    }
    // public function destroy(TeacherAttendance $teacherAttendance)
    // {
    //     abort_if(Gate::denies('staff_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $teacherAttendance->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
