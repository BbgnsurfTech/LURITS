<?php

namespace App\Http\Requests;

use App\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySchoolRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:schools,id',
        ];
    }
}
