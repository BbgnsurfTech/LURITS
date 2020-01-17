<?php

namespace App\Http\Requests;

use App\StudentAdmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentAdmissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_admissions,id',
        ];
    }
}
