<?php

namespace App\Http\Requests;

use App\Teacher;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('teacher_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'   => [
                'max:50',
                'required',
            ],
            'middle_name'  => [
                'max:50',
            ],
            'last_name'    => [
                'max:50',
                'required',
            ],
            'phone_number' => [
                'min:10',
                'max:11',
                'required',
                'unique:teachers,phone_number,' . request()->route('teacher')->id,
            ],
        ];
    }
}
