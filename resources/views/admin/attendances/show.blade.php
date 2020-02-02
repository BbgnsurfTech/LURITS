@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attendance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.id') }}
                        </th>
                        <td>
                            {{ $attendance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.admission') }}
                        </th>
                        <td>
                            {{ $attendance->admission->child_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.attendance_status_morninig') }}
                        </th>
                        <td>
                            {{ App\Attendance::ATTENDANCE_STATUS_MORNINIG_RADIO[$attendance->attendance_status_morninig] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.attendance_status_afternoon') }}
                        </th>
                        <td>
                            {{ App\Attendance::ATTENDANCE_STATUS_AFTERNOON_RADIO[$attendance->attendance_status_afternoon] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.late_status_y_n') }}
                        </th>
                        <td>
                            {{ App\Attendance::LATE_STATUS_Y_N_RADIO[$attendance->late_status_y_n] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection