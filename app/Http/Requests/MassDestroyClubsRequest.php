<?php

namespace App\Http\Requests;

use App\Club;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClubsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('clubs_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:clubs,id',
        ];
    }
}
