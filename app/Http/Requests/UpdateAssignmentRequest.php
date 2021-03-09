<?php

namespace App\Http\Requests;

use App\Assignment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('assignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'staff_id'              => [
                'required',
            ],
            'assignment'      => [                
                'required',
            ],
            'term'                => [
                'required',
            ],
            'class_id'     => [
                'required',
            ],
            'subject'          => [                
                'required',
            ],
            'week'          => [                
                'required',
            ],
            'date'          => [                
                'required',
            ],
            'topic'          => [                
                'required',
            ],
        ];
    }
}
