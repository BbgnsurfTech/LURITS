<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\Http\Resources\Admin\StudentAdmissionResource;
use App\Classroom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Term;
use App\Session;

class ClassroomApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('classroom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new ClassroomResource(Classroom::with(['school_enrolled', 'school'])->get());
        $data = Classroom::with(["classCondition", "school_enrolled"])->get();
        return response(
            json_decode($data),
        200);
    }

    public function store(Request $request)
    {
        // $classroom = Classroom::create($request->all());

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        //dd($term_id);

        $classroom = new Classroom();
        $classroom->capacity = $request->capacity;
        $classroom->year = $request->year;
        $classroom->condition = $request->condition;
        $classroom->length = $request->length;
        $classroom->width = $request->width;
        $classroom->floor_material = $request->floor_material;
        $classroom->wall_material = $request->wall_material;
        $classroom->roof_material = $request->roof_material;
        $classroom->seating = $request->seating;
        $classroom->writing_board = $request->writing_board;
        $classroom->school_id = $request->school_id;
        $classroom->term_id = $term_id[0]->id;
        $classroom->session_id = $session_id[0]->id;
        $final = $classroom->save();

        if ($final) {
            return response([
                'success' => true,
                'message' => "Classroom Data Added Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new ClassroomResource($classroom))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClassroomResource($classroom->load(['school_enrolled', 'school']));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        if ($classroom) {
            return response([
                'success' => true,
                'message' => "Classroom Data Updated Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new ClassroomResource($classroom))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Classroom $classroom)
    {
        // abort_if(Gate::denies('classroom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->delete();

        if ($classroom) {
            return response([
                'success' => true,
                'message' => "Classroom Data Added Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
    }
}
