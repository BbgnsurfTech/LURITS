@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} New Toilet</h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.toilets.store") }}" enctype="multipart/form-data">
            @csrf
        @include('partials.filter.school')
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="year">Year of construction</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year') }}" required>
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
                        <option value="{{ $condition->id }}" {{ old('condition', '255') === (string) $condition->id ? 'selected' : '' }}>{{ $condition->title }}</option>
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
                        <option value="{{ $user_toilet->id }}" {{ old('user_toilet', '255') === (string) $user_toilet->id ? 'selected' : '' }}>{{ $user_toilet->title }}</option>
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
                        <option value="{{ $toilet_type->id }}" {{ old('toilet_type', '255') === (string) $toilet_type->id ? 'selected' : '' }}>{{ $toilet_type->title }}</option>
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
                        <option value="{{ $toilet_usage->id }}" {{ old('toilet_usage', '255') === (string) $toilet_usage->id ? 'selected' : '' }}>{{ $toilet_usage->title }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-12 form-group">
            <button class="btn btn-primary btn-lg" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
        </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
@endsection