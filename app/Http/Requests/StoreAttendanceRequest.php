<?php

namespace App\Http\Requests;

use App\Attendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'admission_id' => [
                'required',
            ],
            'school_id' => [
                'required',
            ],
            'class_id' => [
                'required',
            ],
            'date' => [
                'required',
            ],
        ];
    }
}
