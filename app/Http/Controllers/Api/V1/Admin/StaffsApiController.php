<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Staff;
use App\Term;
use App\AtlasLink;
use App\Session;
use App\School;
use App\Atlas;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StaffsApiController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new TeacherResource(Teacher::with(['school'])->get());

        $data = Staff::where("school_id", Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
    {
        if (Auth::User()->is_headTeacher) {
            $staff_school = Auth::User()->school_id;
        } else {
            $request->validate([
                'school' => "required",
            ]);
            $staff_school = $request->school;
        }

        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        
        
        $r = School::find($staff_school)->lga->code_atlas_entity;
        $rr = Atlas::where('code_atlas_entity', $r)->pluck('short_code')->first();
        $rrr = AtlasLink::where('code_atlas_entity', $r)->get();
        $s = Staff::count() +1;
        $t = $rr.'-';
        $u = str_pad($t, 10, '0', STR_PAD_RIGHT).$s;

        if ($request->type_of_staff == 1 || $request->type_of_staff == 2 || $request->type_of_staff == 3 || $request->type_of_staff == 4 || $request->type_of_staff == 5) {
            $role = 5;
        } elseif ($request->type_of_staff == 6 || $request->type_of_staff == 7) {
            $role = 6;
        } else {
            $role = null;
        }

        DB::beginTransaction();
        try {
            $allData = $request->all();

            foreach ($allData as $staffData) {
                $data_id = Staff::where('school_id', $staff_school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($staff_school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($staffData['id'] == '' || $staffData['id'] == null) {
                    $user = new User();
                    $user->name = $staffData['first_name']. ' ' .$staffData['middle_name']. ' ' .$staffData['last_name'];
                    if ($staffData['email'] !== null || $staffData['email'] !== '') {
                        $user->email = $staffData['email'];
                    } else {
                        $user->username = 'custom_username';
                    }
                    $user->password = Hash::make(12345678);
                    $user->school_id = $staff_school;
                    $user->save();
                    $user->toArray();
                    if ($role !== null) {
                        $user->roles()->sync($role);
                    }

                    $data = new Staff();

                } else {
                    $data = Staff::find($staffData['id']);
                }
                
                if ($staffData['id'] == '' || $staffData['id'] == null) {
                    $data->id = $model_id;
                    $data->staff_id = $u;
                    $data->user_id = $user->id;
                }
                
                $data->first_name = $staffData['first_name'];
                $data->middle_name = $staffData['middle_name'];
                $data->last_name = $staffData['last_name'];
                $data->email = $staffData['email'];
                $data->address = $staffData['address'];
                $data->phone_number = $staffData['phone_number'];
                $data->date_of_birth = $staffData['date_of_birth'];
                $data->state_of_origin_id = $staffData['state_of_origin_id'];
                $data->lga_of_origin_id = $staffData['lga_of_origin_id'];
                $data->marital_status_id = $staffData['marital_status_id'];
                $data->disability_id = $staffData['disability_id'];
                $data->grade_step = $staffData['grade_step'];
                $data->step = $staffData['step'];
                $data->gender_id = $staffData['gender_id'];
                $data->type_staff_id = $staffData['type_staff_id'];
                $data->other_qualification = $staffData['other_qualification'];
                $data->other_salary_source = $staffData['other_salary_source'];
                $data->present_status_id = $staffData['present_status_id'];
                $data->academic_qualification_id = $staffData['academic_qualification_id'];
                $data->teaching_type_id = $staffData['teaching_type_id'];
                $data->salary_source_id = $staffData['salary_source_id'];
                $data->year_first_appointment = $staffData['year_first_appointment'];
                $data->year_present_appointment = $staffData['year_present_appointment'];
                $data->year_posting_to_school = $staffData['year_posting_to_school'];
                if ($staffData['teaching_type_id'] == 2){
                    $data->teaching_type_part_time = $staffData['teaching_type_part_time'];
                }
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_id = $staff_school;
                if ($staffData['academic_qualification_id'] !== "1") {
                    $data->rank_id = $staffData['rank_id'];
                    $data->teaching_qualification_id = $staffData['teaching_qualification_id'];
                    $data->area_of_specialization_id = $staffData['area_of_specialization_id'];
                    $data->subject_of_qualification_id = $staffData['subject_of_qualification_id'];
                    $data->main_subject_taught_id = $staffData['main_subject_taught_id'];
                    $data->seminar_workshop_id = $staffData['seminar_workshop_id'];
                    $data->other_area_of_specialization = $staffData['other_area_of_specialization'];
                    $data->other_subject_of_qualification = $staffData['other_subject_of_qualification'];
                    $data->other_main_subject_taught = $staffData['other_main_subject_taught'];
                }

                if ($staffData['id'] == '' || $staffData['id'] == null) {
                    $results = $data->save();
                } else {
                    $results = $data->update();
                }

            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($results) {
            $message = Staff::where('school_id', $staff_school)->get();
            return response($message);
        }

        
    }

    public function destroy(Staff $staff)
    {
        abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $staff->delete();

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
