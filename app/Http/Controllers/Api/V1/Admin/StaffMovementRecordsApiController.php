<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\StaffMovementRecord;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Session;
use App\Term;
use Auth;
use DB;


class StaffMovementRecordsApiController extends Controller
{
    public function index()
    {
        // $data = StaffMovementRecord::with(["staff"])->get();
        // return response(
        //     json_decode($data),
        // 200);

        $data = StaffMovementRecord::where("school_id", Auth::User()->school_id)->get();
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
        
        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $modelData) {
                $data_id = StaffMovementRecord::where('school_id', $school_id)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $data = new StaffMovementRecord();
                } else {
                    $data = StaffMovementRecord::find($modelData['id']);
                }

                $data->id = $model_id;
                $data->date = $modelData['date'];
                $data->staff_id = $modelData['staff_id'];
                $data->contact_number = $modelData['contact_number'];
                $data->purpose = $modelData['purpose'];
                $data->time_out = $modelData['time_out'];
                $data->time_back = $modelData['time_back'];
                $data->ht_approval = $modelData['ht_approval'];
                $data->school_id = $school_id;
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
            $message = StaffMovementRecord::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(StaffMovementRecord $smr)
    {
        // abort_if(Gate::denies('smr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $smr->delete();

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
