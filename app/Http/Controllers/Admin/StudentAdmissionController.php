<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentAdmissionRequest;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\StudentAdmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAdmissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmissions = StudentAdmission::all();

        return view('admin.studentAdmissions.index', compact('studentAdmissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_admission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentAdmissions.create');
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        $studentAdmission = StudentAdmission::create($request->all());

        return redirect()->route('admin.student-admissions.index');
    }

    public function edit(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentAdmissions.edit', compact('studentAdmission'));
    }

    public function update(UpdateStudentAdmissionRequest $request, StudentAdmission $studentAdmission)
    {
        $studentAdmission->update($request->all());

        return redirect()->route('admin.student-admissions.index');
    }

    public function show(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
}
