@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.teacherAttendance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teacher-attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.teacherAttendance.fields.id') }}
                        </th>
                        <td>
                            {{ $teacherAttendance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacherAttendance.fields.admission') }}
                        </th>
                        <td>
                            {{ $teacherAttendance->admission->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacherAttendance.fields.attendance_status_morninig') }}
                        </th>
                        <td>
                            {{ App\TeacherAttendance::ATTENDANCE_STATUS_MORNINIG_RADIO[$teacherAttendance->attendance_status_morninig] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacherAttendance.fields.attendance_status_afternoon') }}
                        </th>
                        <td>
                            {{ App\TeacherAttendance::ATTENDANCE_STATUS_AFTERNOON_RADIO[$teacherAttendance->attendance_status_afternoon] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacherAttendance.fields.late_status_y_n') }}
                        </th>
                        <td>
                            {{ App\TeacherAttendance::LATE_STATUS_Y_N_RADIO[$teacherAttendance->late_status_y_n] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teacher-attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection