<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\Admin\TeacherResource;
use App\Teacher;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeachersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherResource(Teacher::with(['team'])->get());
    }

    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create($request->all());

        return (new TeacherResource($teacher))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Teacher $teacher)
    {
        abort_if(Gate::denies('teacher_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherResource($teacher->load(['team']));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->all());

        return (new TeacherResource($teacher))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Teacher $teacher)
    {
        abort_if(Gate::denies('teacher_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacher->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
