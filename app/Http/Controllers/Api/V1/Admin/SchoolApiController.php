<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Http\Resources\Admin\SchoolResource;
use App\School;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\SchoolAtlas;
use App\SchoolBackground;
use Auth;

class SchoolApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new SchoolResource(School::with(['school'])->get());

        $data = School::limit(10)->get();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreSchoolRequest $request)
    {
        DB::beginTransaction();
        try {
            
            $school = new School();
            $school->name = $request->name;
            $school->pseudo_code = $request->pseudo_code;
            $school->nemis_code = $request->nemis_code;
            $school->number_and_street = $request->number_and_street;
            $school->school_community = $request->school_community;
            $school->village_town = $request->village_town;
            $school->email_address = $request->email_address;
            $school->school_telephone = $request->school_telephone;
            $school->code_type_sector = $request->code_type_sector;
            $school->latitude_north = $request->latitude_north;
            $school->longitude_east = $request->longitude_east;
            $school->nearby_name_school = $request->nearby_name_school;
            $school->save();

            $data=[
                "school_id" => $school->id,
                "code_atlas_entity" => $request->lga,
            ];

            $lgaa = SchoolAtlas::insert($data);

            DB::commit();

            return response([
                'success' => true,
                'message' => "School Data Added Successfully",
            ], 200);
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => "Something went wrong. Contact Administrator",
            ], 200);
        }

        // $school = School::create($request->all());

        // return (new SchoolResource($school))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function updateBackground(Request $request)
    {
        $allData = $request->all();

        DB::beginTransaction();
        try {
            $data = SchoolBackground::where('school_id', Auth::User()->school_id)->first();
            // dd($data);
            $data->update($allData['school_background']);

            $schoolData = Auth::User()->school;
            $schoolData->latitude_north = $allData['school_information']['latitude_north'];
            $schoolData->longitude_east = $allData['school_information']['longitude_east'];
            $schoolData->number_and_street = $allData['school_information']['number_and_street'];
            $schoolData->school_community = $allData['school_information']['school_community'];
            $schoolData->village_town = $allData['school_information']['village_town'];
            $schoolData->email_address = $allData['school_information']['email_address'];
            $schoolData->school_telephone = $allData['school_information']['school_telephone'];
            $schoolData->ward = $allData['school_information']['ward'];
            $schoolData->update();
            // dd($schoolData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response($e);
        }
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        if ($school) {
            return response([
                'success' => true,
                'message' => "School Data Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return response(null, Response::HTTP_NO_CONTENT);
    }
}
