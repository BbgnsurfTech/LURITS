<?php

namespace App\Http\Requests;

use App\Lcr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLcrRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lcr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'student_id'              => [
                'required',
            ],
            'last_class_passed_id'     => [
                'required',
            ],
            'date_of_graduation'          => [                
                'required',
            ],
            'parent_guardian_id'          => [
                'required',
            ],
            'headteacher_name'          => [
                'required',
            ],
            'headteacher_phone'          => [
                'required',
            ],
        ];
    }
}
