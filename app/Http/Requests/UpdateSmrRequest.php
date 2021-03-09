<?php

namespace App\Http\Requests;

use App\Smr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSmrRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('smr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'   => [                
                'required',
                'date_format:Y/m/d',
                
            ],
            'staff_id'              => [
                'required',
            ],
            'time_out'          => [                
                'required',
            ],
            'time_back'          => [                
                'required',
            ],
        ];
    }
}
