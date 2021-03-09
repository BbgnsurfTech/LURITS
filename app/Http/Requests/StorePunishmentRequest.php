<?php

namespace App\Http\Requests;

use App\Punishment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePunishmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('punishment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'              => [
                'required',
            ],
            'age'      => [                
                'required',
            ],
            'class_id'                => [
                'required',
            ],
            'offence'     => [
                'required',
            ],
            'punishment'          => [
                'required',
            ],
            'student_id'          => [
                'required',
            ],
            'remark'          => [
                'required',
            ],
            'punished_by'          => [
                'required',
            ],
        ];
    }
}
