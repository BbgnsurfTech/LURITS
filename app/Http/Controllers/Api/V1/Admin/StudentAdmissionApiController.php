<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\Http\Resources\Admin\StudentAdmissionResource;
use App\StudentAdmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Session;
use App\Term;
use App\School;
use App\Atlas;
use Auth;

class StudentAdmissionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new StudentAdmissionResource(StudentAdmission::with(['school_enrolled', 'classroom', 'parent_guardian', 'school'])->get());
        // $data = StudentAdmission::with(["gender", "bloodgroup", "maritalstatus", "disability", "state_origin", "lga_origin", "parent_guardian", "school_enrolled", "religion"])->get();
        // return response(
        //     json_decode($data),
        // 200);

        $data = StudentAdmission::where("school_enrolled_id", Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $session_id = Session::where('active_status', 1)->pluck('id')->first();
            $term_id = Term::where('active_status', 1)->pluck('id')->first();

            if (Auth::User()->is_headTeacher) {
                $school_id = Auth::User()->school_id;
                $r = Auth::User()->school->lga->code_atlas_entity;
            } else {
                $request->validate([
                    'school' => "required",
                ]);
                $school_id = $request->school;
                $r = School::find($school_id)->lga->code_atlas_entity;
            }

            $rr = Atlas::where('code_atlas_entity', $r)->pluck('short_code')->first();
            $s = StudentAdmission::max('id') +1;
            $u = str_pad($rr.'-', 10, '0', STR_PAD_RIGHT).$s;
            // dd($u);

            $allData = $request->all();

            foreach ($allData as $studentData) {
                $data_id = StudentAdmission::where('school_enrolled_id', $school_id)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($studentData['id'] == '' || $studentData['id'] == null) {
                    $data = new StudentAdmission();
                } else {
                    $data = StudentAdmission::find($studentData['id']);
                }

                
                $data->id = $model_id;
                $data->child_name = $studentData['child_name'];
                $data->middle_name = $studentData['middle_name'];
                $data->last_name = $studentData['last_name'];
                $data->date_of_birth = $studentData['date_of_birth'];
                $data->admission_number = $u;
                $data->address = $studentData['address'];
                $data->marital_status_id  = $studentData['marital_status_id'];
                $data->disability = $studentData['disability'];
                $data->hobby = $studentData['hobby'];
                $data->religion_id = $studentData['religion_id'];
                $data->gender_id = $studentData['gender_id'];
                $data->blood_group_id = $studentData['blood_group_id'];
                $data->state_of_origin_id = $studentData['state_of_origin_id'];
                $data->nationality_id = 1;
                $data->lga_of_origin_id = $studentData['lga_of_origin_id'];
                $data->class_id = $studentData['class_id'];
                $data->parent_guardian_id = $studentData['parent_guardian_id'];
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_enrolled_id = $school_id;

                if ($studentData['id'] == '' || $studentData['id'] == null) {
                    $final = $data->save();
                } else {
                    $final = $data->update();
                }
                
            }

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($final) {
            $message = StudentAdmission::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(StudentAdmission $studentAdmission)
    {
        // abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $studentAdmission->delete();

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
