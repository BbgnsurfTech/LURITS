<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\Http\Resources\Admin\StudentAdmissionResource;
use App\Transfer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferApiController extends Controller
{
    public function index()
    {
        // $data = Transfer::with(["student", "school_enrolled", "school", "classroom"])->get();
        // return response(
        //     json_decode($data),
        // 200);

        $data = Transfer::where("school_id", Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        if (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
        } else {
            $request->validate([
                'school' => "required",
            ]);
            $school_id = $request->school;
        }

        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        
        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $modelData) {
                $data_id = Transfer::where('school_id', $school_id)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $data = new Transfer();
                } else {
                    $data = Transfer::find($modelData['id']);
                }

                $data->student_id = $modelData['student_id'];
                $data->class_id = $modelData['class_id'];
                // $data->last_class_attended = $request->last_class_attended;
                // $data->pupils_conduct = $request->pupils_conduct;
                // $data->reason_for_leaving = $request->reason_for_leaving;
                // $data->last_attendace_date = $request->last_attendance_date;
                $data->old_school = $modelData['old_school'];
                $data->new_school = Auth::User()->school_id;
                // $data->headteacher_name = $request->headteacher_name;
                // $data->headteacher_phone = $request->headteacher_phone;
                $data->term_id = $term_id;
                $data->session_id = $session_id;

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $final = $data->save();
                } else {
                    $final = $data->update();
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($final) {
            $message = Transfer::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(Transfer $transfer)
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $transfer->delete();

        if ($final) {
            return response([
                'success' => true,
                'message' => "Data Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
    }
}
