<?php

namespace App\Http\Requests;

use App\Visitor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassVisitorsLeaveRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('visitors_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:visitor,id',
        ];
    }
}
