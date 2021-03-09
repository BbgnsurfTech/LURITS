<?php

namespace App\Http\Requests;

use App\Attendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'attendance'  => [
                'required',
            ],
            'admission_id' => [
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
