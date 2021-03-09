@extends('layouts.admin')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.classroom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.classrooms.update", [$classroom->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('partials.filter.school')
            <div class="form-group">
                <label class="required" for="capacity">{{ trans('cruds.classroom.fields.capacity') }}</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="capacity" id="capacity" value="{{ old('capacity', $classroom->capacity) }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="current_capacity">Current Class Capacity</label>
                <input class="form-control {{ $errors->has('current_capacity') ? 'is-invalid' : '' }}" type="number" name="current_capacity" id="current_capacity" value="{{ old('current_capacity', $classroom->current_capacity) }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.classroom.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', $classroom->year) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="condition">{{ trans('cruds.classroom.fields.condition') }}</label>
                <select class="form-control {{ $errors->has('condition') ? 'is-invalid' : '' }}" name="condition" id="condition" required>
                    <option value disabled {{ old('condition', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($conditions as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->condition ? $classroom->classCondition->id : old('condition')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="length">{{ trans('cruds.classroom.fields.length') }}</label>
                <input class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="number" name="length" id="length" value="{{ old('length', $classroom->length) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.length_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="width">{{ trans('cruds.classroom.fields.width') }}</label>
                <input class="form-control {{ $errors->has('width') ? 'is-invalid' : '' }}" type="number" name="width" id="width" value="{{ old('width', $classroom->width) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.width_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="floor_material">{{ trans('cruds.classroom.fields.floor_material') }}</label>
                <select class="form-control {{ $errors->has('floor_material') ? 'is-invalid' : '' }}" name="floor_material" id="floor_material" required>
                    <option value disabled {{ old('floor_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($floor_materials as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->floor_material ? $classroom->floorMaterial->id : old('floor_material')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="wall_material">{{ trans('cruds.classroom.fields.wall_material') }}</label>
                <select class="form-control {{ $errors->has('wall_material') ? 'is-invalid' : '' }}" name="wall_material" id="wall_material" required>
                    <option value disabled {{ old('wall_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($wall_materials as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->wall_material ? $classroom->wallMaterial->id : old('wall_materials')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="roof_material">{{ trans('cruds.classroom.fields.roof_material') }}</label>
                <select class="form-control {{ $errors->has('roof_material') ? 'is-invalid' : '' }}" name="roof_material" id="roof_material" required>
                    <option value disabled {{ old('roof_material', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($roof_materials as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->roof_material ? $classroom->floorMaterial->id : old('roof_material')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="seating">{{ trans('cruds.classroom.fields.seating') }}</label>
                <select class="form-control {{ $errors->has('seating') ? 'is-invalid' : '' }}" name="seating" id="seating" required>
                    <option value disabled {{ old('seating', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($yes_no as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->seating ? $classroom->availableSeating->id : old('seating')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.seating_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="writing_board">{{ trans('cruds.classroom.fields.writing_board') }}</label>
                <select class="form-control {{ $errors->has('writing_board') ? 'is-invalid' : '' }}" name="writing_board" id="writing_board" required>
                    <option value disabled {{ old('writing_board', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($yes_no as $key => $label)
                        <option value="{{ $key }}" {{ ($classroom->writing_board ? $classroom->writingBoard->id : old('writing_board')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classroom.fields.writing_board_helper') }}</span>
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
        '<option value="{{$classroom->school_id}}" selected>'+ "{{$classroom->school->name}}" +'</option>'
        );
    });
</script>
@endsection