@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentAdmission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-admissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="child_name">{{ trans('cruds.studentAdmission.fields.child_name') }}</label>
                <input class="form-control {{ $errors->has('child_name') ? 'is-invalid' : '' }}" type="text" name="child_name" id="child_name" value="{{ old('child_name', '') }}">
                @if($errors->has('child_name'))
                    <span class="text-danger">{{ $errors->first('child_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.child_name_helper') }}</span>
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