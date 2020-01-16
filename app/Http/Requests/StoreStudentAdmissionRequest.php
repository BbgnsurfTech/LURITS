<?php

namespace App\Http\Requests;

use App\StudentAdmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreStudentAdmissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_admission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'child_name' => [
                'min:2',
                'max:50',
            ],
        ];
    }
}
