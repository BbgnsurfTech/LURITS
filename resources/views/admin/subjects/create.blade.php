@extends('layouts.admin')
@section('content')
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{ trans('cruds.subjects.title_singular') }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.subjects.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="subject">{{ trans('cruds.subjects.title_singular') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="l-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $class)
                        <option value="{{ $class->id }}" >{{ $class->class }} {{ $class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



@endsection
