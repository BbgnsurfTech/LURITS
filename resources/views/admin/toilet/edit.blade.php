@extends('layouts.admin')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Toilet
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.toilets.update", [$toilet->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('partials.filter.school')
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="year">Year of construction</label>
                    <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', $toilet->year_construction) }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.classroom.fields.year_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Condition</label>
                    <select class="form-control {{ $errors->has('condition') ? 'is-invalid' : '' }}" name="condition" id="condition" required>
                        <option value disabled {{ old('condition', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}" 
                                {{ ($toilet->ds_condition_id ? $toilet->ds_condition_id : old('condition')) == $condition->id ? 'selected' : '' }}
                                >{{ $condition->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Usablity</label>
                    <select class="form-control {{ $errors->has('user_toilet') ? 'is-invalid' : '' }}" name="user_toilet" id="user_toilet" required>
                        <option value disabled {{ old('user_toilet', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($ds_user_toilet as $user_toilet)
                            <option value="{{ $user_toilet->id }}" 
                                {{ ($toilet->ds_user_toilet_id ? $toilet->ds_user_toilet_id : old('condition')) == $user_toilet->id ? 'selected' : '' }}
                                >{{ $user_toilet->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Type</label>
                    <select class="form-control {{ $errors->has('toilet_type') ? 'is-invalid' : '' }}" name="toilet_type" id="toilet_type" required>
                        <option value disabled {{ old('toilet_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($ds_toilet as $toilet_type)
                            <option value="{{ $toilet_type->id }}"
                                {{ ($toilet->ds_toilet_id ? $toilet->ds_toilet_id : old('condition')) == $toilet_type->id ? 'selected' : '' }}
                                >{{ $toilet_type->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Toilet Usage</label>
                    <select class="form-control {{ $errors->has('toilet_usage') ? 'is-invalid' : '' }}" name="toilet_usage" id="toilet_usage" required>
                        <option value disabled {{ old('toilet_usage', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($ds_toilet_usage as $toilet_usage)
                            <option value="{{ $toilet_usage->id }}" {{ ($toilet->ds_toilet_usage_id ? $toilet->ds_toilet_usage_id : old('condition')) == $toilet_usage->id ? 'selected' : '' }}>{{ $toilet_usage->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').append(
        '<option value="{{$toilet->school_id}}" selected>'+ "{{$toilet->school->name}}" +'</option>'
        );
    });
</script>
@endsection