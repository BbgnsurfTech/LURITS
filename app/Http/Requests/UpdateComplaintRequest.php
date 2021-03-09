<?php

namespace App\Http\Requests;

use App\Complaint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateComplaintRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'complaint'          => [                
                'required',
            ],
            'action'          => [
                'required',
            ],
            'phone'          => [
                'required',
            ],
        ];
    }
}
