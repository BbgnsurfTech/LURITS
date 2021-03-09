<?php

namespace App\Http\Requests;

use App\Postal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('postal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:postals,id',
        ];
    }
}
