@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{ trans('cruds.classroom.title_singular') }}</h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.classrooms.store") }}" enctype="multipart/form-data">
            @csrf
        @include('partials.filter.school')
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="capacity">{{ trans('cruds.classroom.fields.capacity') }}</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.capacity_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="current_capacity">Current Class Capacity</label>
                <input class="form-control {{ $errors->has('current_capacity') ? 'is-invalid' : '' }}" type="number" name="current_capacity" id="current_capacity" value="{{ old('current_capacity') }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.capacity_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="year">{{ trans('cruds.classroom.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.year_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.condition') }}</label>
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
                <label class="required" for="length">{{ trans('cruds.classroom.fields.length') }}</label>
                <input class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="number" name="length" id="length" value="{{ old('length') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.length_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="width">{{ trans('cruds.classroom.fields.width') }}</label>
                <input class="form-control {{ $errors->has('width') ? 'is-invalid' : '' }}" type="number" name="width" id="width" value="{{ old('width') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.width_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.floor_material') }}</label>
                <select class="form-control {{ $errors->has('floor_material') ? 'is-invalid' : '' }}" name="floor_material" id="floor_material" required>
                    <option value disabled {{ old('floor_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($floor_materials as $floor_material)
                        <option value="{{ $floor_material->id }}" {{ old('floor_material', '255') === (string) $floor_material->id ? 'selected' : '' }}>{{ $floor_material->title }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.wall_material') }}</label>
                <select class="form-control {{ $errors->has('wall_material') ? 'is-invalid' : '' }}" name="wall_material" id="wall_material" required>
                    <option value disabled {{ old('wall_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($wall_materials as $wall_material)
                        <option value="{{ $wall_material->id }}" {{ old('wall_material', '255') === (string) $wall_material->id ? 'selected' : '' }}>{{ $wall_material->title }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.roof_material') }}</label>
                <select class="form-control {{ $errors->has('roof_material') ? 'is-invalid' : '' }}" name="roof_material" id="roof_material" required>
                    <option value disabled {{ old('roof_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($roof_materials as $roof_material)
                        <option value="{{ $roof_material->id }}" {{ old('roof_material', '255') === (string) $roof_material->id ? 'selected' : '' }}>{{ $roof_material->title }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.seating') }}</label>
                <select class="form-control {{ $errors->has('seating') ? 'is-invalid' : '' }}" name="seating" id="seating" required>
                    <option value disabled {{ old('seating', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    <option value="1" {{ old('seating', '255') === (string) 1 ? 'selected' : '' }}>Yes</option>
                    <option value="2" {{ old('seating', '255') === (string) 2 ? 'selected' : '' }}>No</option>
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.seating_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ trans('cruds.classroom.fields.writing_board') }}</label>
                <select class="form-control {{ $errors->has('writing_board') ? 'is-invalid' : '' }}" name="writing_board" id="writing_board" required>
                    <option value disabled {{ old('writing_board', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    <option value="1" {{ old('writing_board', '255') === (string) 1 ? 'selected' : '' }}>Yes</option>
                    <option value="2" {{ old('writing_board', '255') === (string) 2 ? 'selected' : '' }}>No</option>
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.writing_board_helper') }}</span>
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
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
@endsection