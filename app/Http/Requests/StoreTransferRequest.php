<?php

namespace App\Http\Requests;

use App\Transfer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTransferRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_transfer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'student_id'              => [
                'required',
            ],
            'last_class_attended'     => [
                'required',
            ],
            'pupils_conduct'          => [
                'max:50',
            ],
            'reason_for_leaving'      => [
                'max:150',
            ],
            'headteacher_name'          => [
                'required',
            ],
            'headteacher_phone'          => [
                'required',
            ],
        ];
    }
}
