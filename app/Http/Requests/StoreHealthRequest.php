<?php

namespace App\Http\Requests;

use App\Health;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreHealthRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('health_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'              => [
                'required',
            ],
            'student_id'          => [
                'required',
            ],
        ];
    }
}
