@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subjects.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subjects.update", $subject->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="subject">{{ trans('cruds.subjects.title') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="ds_subject_name" id="subject" value="{{ old('ds_subject_name', $subject->ds_subject_name) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subjects.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}" {{ ($subject->class_id ? $subject->class_id : old('class_id')) == $class_id->id ? 'selected' : '' }}>{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
