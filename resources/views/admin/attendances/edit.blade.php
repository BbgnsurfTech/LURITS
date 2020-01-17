@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.attendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendances.update", [$attendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="admission_id">{{ trans('cruds.attendance.fields.admission') }}</label>
                <select class="form-control select2 {{ $errors->has('admission') ? 'is-invalid' : '' }}" name="admission_id" id="admission_id">
                    @foreach($admissions as $id => $admission)
                        <option value="{{ $id }}" {{ ($attendance->admission ? $attendance->admission->id : old('admission_id')) == $id ? 'selected' : '' }}>{{ $admission }}</option>
                    @endforeach
                </select>
                @if($errors->has('admission_id'))
                    <span class="text-danger">{{ $errors->first('admission_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.admission_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.attendance.fields.attendance_status_morninig') }}</label>
                @foreach(App\Attendance::ATTENDANCE_STATUS_MORNINIG_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('attendance_status_morninig') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="attendance_status_morninig_{{ $key }}" name="attendance_status_morninig" value="{{ $key }}" {{ old('attendance_status_morninig', $attendance->attendance_status_morninig) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="attendance_status_morninig_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('attendance_status_morninig'))
                    <span class="text-danger">{{ $errors->first('attendance_status_morninig') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.attendance_status_morninig_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.attendance.fields.attendance_status_afternoon') }}</label>
                @foreach(App\Attendance::ATTENDANCE_STATUS_AFTERNOON_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('attendance_status_afternoon') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="attendance_status_afternoon_{{ $key }}" name="attendance_status_afternoon" value="{{ $key }}" {{ old('attendance_status_afternoon', $attendance->attendance_status_afternoon) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="attendance_status_afternoon_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('attendance_status_afternoon'))
                    <span class="text-danger">{{ $errors->first('attendance_status_afternoon') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.attendance_status_afternoon_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.attendance.fields.late_status_y_n') }}</label>
                @foreach(App\Attendance::LATE_STATUS_Y_N_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('late_status_y_n') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="late_status_y_n_{{ $key }}" name="late_status_y_n" value="{{ $key }}" {{ old('late_status_y_n', $attendance->late_status_y_n) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="late_status_y_n_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('late_status_y_n'))
                    <span class="text-danger">{{ $errors->first('late_status_y_n') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.late_status_y_n_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection