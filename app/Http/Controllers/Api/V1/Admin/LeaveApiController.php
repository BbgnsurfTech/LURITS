<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Resources\Admin\LeaveResource;
use App\Leave;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Staff;
use Auth;
use DB;

class LeaveApiController extends Controller
{
    public function index()
    {
        // $data = Leave::with(["staff"])->get();
        // return response(json_decode($data), 200);

        $data = Leave::where("school_id", Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
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
        
        if (Auth::User()->is_teacher) {
            $staff_id = Staff::where('user_id', Auth::User()->id)->pluck('id')->first();
            $school_id = Auth::User()->school_id;
        } elseif (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
        } else {
            $staff_id = $request->staff_id;
            $school_id = $request->school;
        }

        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $modelData) {
                $data_id = Leave::where('school_id', $school_id)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $data = new Leave();
                } else {
                    $data = Leave::find($modelData['id']);
                }

                $data->id = $model_id;
                $data->staff_id = $staff_id;
                $data->status = $modelData['status'];
                $data->contact_number = $modelData['contact_number'];
                $data->address = $modelData['address'];
                $data->number_of_days = $modelData['number_of_days'];
                $data->leave_type = $modelData['leave'];
                $data->remark = $modelData['remark'];
                $data->start_date = $modelData['start_date'];
                $data->end_date = $modelData['end_date'];
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_id = $school_id;

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
            $message = Leave::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(Leave $leave)
    {
        // abort_if(Gate::denies('leave_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $leave->delete();

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
