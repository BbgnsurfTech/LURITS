<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParentGuardianregisterRequest;
use App\Http\Requests\UpdateParentGuardianregisterRequest;
use App\Http\Resources\Admin\ParentGuardianregisterResource;
use App\ParentGuardianregister;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class ParentsApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('parent_guardianregister_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new ParentGuardianregisterResource(Parents::with(['schools'])->get());

        $data = ParentGuardianregister::where('school_id', Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
    {
        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $school = $request->school;
        }

        DB::beginTransaction();
        try {
            $allData = $request->all();

            foreach ($allData as $parentData) {
                $data_id = ParentGuardianregister::where('school_id', $school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($parentData['id'] == '' || $parentData['id'] == null) {
                    $parent = new ParentGuardianregister();

                } else {
                    $parent = ParentGuardianregister::find($parentData['id']);
                }
                
                if ($parentData['id'] == '' || $parentData['id'] == null) {
                    $parent->id = $model_id;
                }

                $parent->first_name = $parentData['first_name'];
                $parent->middle_name = $parentData['middle_name'];
                $parent->last_name = $parentData['last_name'];
                $parent->email = $parentData['email'];
                $parent->income = $parentData['income'];
                $parent->gender_id = $parentData['gender_id'];
                $parent->date_of_birth = $parentData['date_of_birth'];
                $parent->phone_number = $parentData['phone_number'];
                $parent->address = $parentData['address'];
                $parent->profession = $parentData['profession'];
                $parent->school_id = $school;

                if ($parentData['id'] == '' || $parentData['id'] == null) {
                    $results = $parent->save();
                } else {
                    $results = $parent->update();
                }

            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($results) {
            $message = ParentGuardianregister::where('school_id', $school)->get();
            return response($message);
        }
        
    }

    public function destroy($parents)
    {
        // abort_if(Gate::denies('parent_guardianregister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = Parents::find($parents);
        $final = $data->delete();
        
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
