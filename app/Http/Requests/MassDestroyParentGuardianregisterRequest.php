<?php

namespace App\Http\Requests;

use App\ParentGuardianregister;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParentGuardianregisterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('parent_guardianregister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:parent_guardianregisters,id',
        ];
    }
}
