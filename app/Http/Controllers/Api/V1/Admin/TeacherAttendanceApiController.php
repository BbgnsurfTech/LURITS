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

class TeacherAttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('teacher_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherAttendanceResource(TeacherAttendance::with(['admission', 'team'])->get());
    }

    public function store(StoreTeacherAttendanceRequest $request)
    {
        $teacherAttendance = TeacherAttendance::create($request->all());

        return (new TeacherAttendanceResource($teacherAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeacherAttendanceResource($teacherAttendance->load(['admission', 'team']));
    }

    public function update(UpdateTeacherAttendanceRequest $request, TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->update($request->all());

        return (new TeacherAttendanceResource($teacherAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacherAttendance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
