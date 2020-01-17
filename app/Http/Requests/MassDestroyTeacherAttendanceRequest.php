<?php

namespace App\Http\Requests;

use App\TeacherAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTeacherAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('teacher_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:teacher_attendances,id',
        ];
    }
}
