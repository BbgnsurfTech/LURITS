<?php

namespace App\Http\Requests;

use App\Punishment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPunishmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('punishment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:punishment,id',
        ];
    }
}
