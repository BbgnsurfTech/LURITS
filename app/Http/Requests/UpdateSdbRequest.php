<?php

namespace App\Http\Requests;

use App\Sdb;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSdbRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sdb_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'staff_id'              => [
                'required',
            ],
            'rank'      => [                
                'required',
            ],
            'date'                => [
                'required',
            ],
            'offence'     => [
                'required',
            ],
            'number_of_offence'          => [                
                'required',
            ],
            'disciplinary_action'          => [                
                'required',
            ],
            'punished_by'          => [                
                'required',
            ],
        ];
    }
}
