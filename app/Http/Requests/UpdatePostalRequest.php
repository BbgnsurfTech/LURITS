<?php

namespace App\Http\Requests;

use App\Postal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePostalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('postal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'  => [
                'required',
            ],
            'status'  => [
                'required',
            ],
            'description'  => [
                'required',
            ],
            'address'  => [
                'required',
            ],
        ];
    }
}
