<?php

namespace App\Http\Requests;

use App\Smr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySmrRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('smr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:smr,id',
        ];
    }
}
