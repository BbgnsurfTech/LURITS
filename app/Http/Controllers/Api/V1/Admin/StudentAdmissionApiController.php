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

class StudentAdmissionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentAdmissionResource(StudentAdmission::with(['school_enrolled'])->get());
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        $studentAdmission = StudentAdmission::create($request->all());

        if ($request->input('student_picture', false)) {
            $studentAdmission->addMedia(storage_path('tmp/uploads/' . $request->input('student_picture')))->toMediaCollection('student_picture');
        }

        if ($request->input('student_document', false)) {
            $studentAdmission->addMedia(storage_path('tmp/uploads/' . $request->input('student_document')))->toMediaCollection('student_document');
        }

        return (new StudentAdmissionResource($studentAdmission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentAdmissionResource($studentAdmission->load(['school_enrolled']));
    }

    public function update(UpdateStudentAdmissionRequest $request, StudentAdmission $studentAdmission)
    {
        $studentAdmission->update($request->all());

        if ($request->input('student_picture', false)) {
            if (!$studentAdmission->student_picture || $request->input('student_picture') !== $studentAdmission->student_picture->file_name) {
                $studentAdmission->addMedia(storage_path('tmp/uploads/' . $request->input('student_picture')))->toMediaCollection('student_picture');
            }
        } elseif ($studentAdmission->student_picture) {
            $studentAdmission->student_picture->delete();
        }

        if ($request->input('student_document', false)) {
            if (!$studentAdmission->student_document || $request->input('student_document') !== $studentAdmission->student_document->file_name) {
                $studentAdmission->addMedia(storage_path('tmp/uploads/' . $request->input('student_document')))->toMediaCollection('student_document');
            }
        } elseif ($studentAdmission->student_document) {
            $studentAdmission->student_document->delete();
        }

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
