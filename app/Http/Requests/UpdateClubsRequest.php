<?php

namespace App\Http\Requests;

use App\Club;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateClubsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('clubs_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'              => [
                'required',
            ],
            'name'     => [
                'required',
            ],
            'activity'          => [                
                'required',
            ],
            'venue'          => [
                'required',
            ],
            'purpose'          => [
                'required',
            ],
            'participants'          => [
                'required',
            ],
            'duration'          => [
                'required',
            ],
        ];
    }
}
