<?php

namespace App\Http\Requests;

use App\Teacher;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateStaffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'lga_origin' => [
                'required'
            ],
            'phone_number' => [
                'required',
                'max:11',
            ],
            'date_of_birth'   => [                
                'required',
            ],
            'first_appointment'   => [                
                'required',
            ],
            'present_appointment'   => [                
                'required',
            ],
            'posting_to_school'   => [                
                'required',
            ],
            'gender'   => [                
                'required',
            ],
            'type_of_staff'   => [                
                'required',
            ],
            'source_of_salary'   => [                
                'required',
            ],
            'present'   => [                
                'required',
            ],
            'academic_qualification'   => [                
                'required',
            ],
            'teaching_type'   => [                
                'required',
            ],
            'first_name'   => [
                'max:50',
                'required',
            ],
            'middle_name'  => [
                'max:50',
            ],
            'last_name'    => [
                'max:50',
                'required',
            ],
        ];
    }
}
