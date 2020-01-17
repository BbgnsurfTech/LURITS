<?php

namespace App\Http\Requests;

use App\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('team_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'               => [
                'required',
            ],
            'pseudo_code'        => [
                'max:10',
            ],
            'nemis_code'         => [
                'max:10',
            ],
            'number_and_street'  => [
                'max:100',
            ],
            'school_community'   => [
                'min:5',
                'max:100',
            ],
            'village_town'       => [
                'min:5',
                'max:50',
            ],
            'email_address'      => [
                'max:50',
            ],
            'school_telephone'   => [
                'max:11',
            ],
            'code_type_sector'   => [
                'required',
            ],
            'ward'               => [
                'max:50',
            ],
            'nearby_name_school' => [
                'max:100',
            ],
        ];
    }
}
