<?php

namespace App\Http\Requests;

use App\Visitor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVisitorsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('visitors_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'              => [
                'required',
            ],
            'address'      => [                
                'required',
            ],
            'visitors_name'                => [
                'required',
            ],
            'purpose'     => [
                'required',
            ],
            'phone'          => [                
                'required',
            ],
        ];
    }
}
