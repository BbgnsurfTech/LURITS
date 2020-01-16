<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\Http\Resources\Admin\StudentAdmissionResource;
use App\StudentAdmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAdmissionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentAdmissionResource(StudentAdmission::all());
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        $studentAdmission = StudentAdmission::create($request->all());

        return (new StudentAdmissionResource($studentAdmission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentAdmissionResource($studentAdmission);
    }

    public function update(UpdateStudentAdmissionRequest $request, StudentAdmission $studentAdmission)
    {
        $studentAdmission->update($request->all());

        return (new StudentAdmissionResource($studentAdmission))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
