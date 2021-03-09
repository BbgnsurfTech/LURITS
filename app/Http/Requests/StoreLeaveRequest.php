<?php

namespace App\Http\Requests;

use App\Leave;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLeaveRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('leave_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'contact_number'                => [
                'required',
            ],
            'address'     => [
                'required',
            ],
            'start_date'          => [                
                'required',
            ],
            'end_date'          => [                
                'required',
            ],
            'leave_type'          => [                
                'required',
            ],
            'number_of_days'          => [                
                'required',
            ],
        ];
    }
}
