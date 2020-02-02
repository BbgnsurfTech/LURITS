<?php

namespace App\Http\Requests;

use App\TeacherAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTeacherAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('teacher_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'attendance_status_morninig'  => [
                'required',
            ],
            'attendance_status_afternoon' => [
                'required',
            ],
        ];
    }
}
