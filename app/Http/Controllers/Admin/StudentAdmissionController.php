<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentAdmissionRequest;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\StudentAdmission;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StudentAdmissionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmissions = StudentAdmission::all();

        return view('admin.studentAdmissions.index', compact('studentAdmissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_admission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school_enrolleds = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentAdmissions.create', compact('school_enrolleds'));
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        $studentAdmission = StudentAdmission::create($request->all());

        if ($request->input('student_picture', false)) {
            $studentAdmission->addMedia(storage_path('tmp/uploads/' . $request->input('student_picture')))->toMediaCollection('student_picture');
        }

        foreach ($request->input('student_document', []) as $file) {
            $studentAdmission->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('student_document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $studentAdmission->id]);
        }

        return redirect()->route('admin.student-admissions.index');
    }

    public function edit(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school_enrolleds = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentAdmission->load('school_enrolled');

        return view('admin.studentAdmissions.edit', compact('school_enrolleds', 'studentAdmission'));
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

        if (count($studentAdmission->student_document) > 0) {
            foreach ($studentAdmission->student_document as $media) {
                if (!in_array($media->file_name, $request->input('student_document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $studentAdmission->student_document->pluck('file_name')->toArray();

        foreach ($request->input('student_document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $studentAdmission->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('student_document');
            }
        }

        return redirect()->route('admin.student-admissions.index');
    }

    public function show(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission->load('school_enrolled', 'admissionAttendances');

        return view('admin.studentAdmissions.show', compact('studentAdmission'));
    }

    public function destroy(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentAdmissionRequest $request)
    {
        StudentAdmission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_admission_create') && Gate::denies('student_admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudentAdmission();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
