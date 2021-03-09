<?php

namespace App\Http\Requests;

use App\Leave;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLeaveRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('leave_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'staff_id'              => [
                'required',
            ],
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
