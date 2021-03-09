<?php

namespace App\Http\Requests;

use App\DsSubject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSubjectsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ds_subject_name'          => [
                'min:2',
                'max:50',
                'required',
            ],
            'class_id' => [
                'required',
            ],
        ];
    }
}
