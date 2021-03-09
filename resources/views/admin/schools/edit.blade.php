@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.team.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.schools.update", [$school->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.team.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $school->name) }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pseudo_code">{{ trans('cruds.team.fields.pseudo_code') }}</label>
                    <input class="form-control {{ $errors->has('pseudo_code') ? 'is-invalid' : '' }}" type="text" name="pseudo_code" id="pseudo_code" value="{{ old('pseudo_code', $school->pseudo_code) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.pseudo_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="nemis_code">{{ trans('cruds.team.fields.nemis_code') }}</label>
                    <input class="form-control {{ $errors->has('nemis_code') ? 'is-invalid' : '' }}" type="text" name="nemis_code" id="nemis_code" value="{{ old('nemis_code', $school->nemis_code) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.nemis_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="number_and_street">{{ trans('cruds.team.fields.number_and_street') }}</label>
                    <input class="form-control {{ $errors->has('number_and_street') ? 'is-invalid' : '' }}" type="text" name="number_and_street" id="number_and_street" value="{{ old('number_and_street', $school->number_and_street) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.number_and_street_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="school_community">{{ trans('cruds.team.fields.school_community') }}</label>
                    <input class="form-control {{ $errors->has('school_community') ? 'is-invalid' : '' }}" type="text" name="school_community" id="school_community" value="{{ old('school_community', $school->school_community) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.school_community_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village_town">{{ trans('cruds.team.fields.village_town') }}</label>
                    <input class="form-control {{ $errors->has('village_town') ? 'is-invalid' : '' }}" type="text" name="village_town" id="village_town" value="{{ old('village_town', $school->village_town) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.village_town_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email_address">{{ trans('cruds.team.fields.email_address') }}</label>
                    <input class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}" type="text" name="email_address" id="email_address" value="{{ old('email_address', $school->email_address) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.email_address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="school_telephone">{{ trans('cruds.team.fields.school_telephone') }}</label>
                    <input class="form-control {{ $errors->has('school_telephone') ? 'is-invalid' : '' }}" type="text" name="school_telephone" id="school_telephone" value="{{ old('school_telephone', $school->school_telephone) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.school_telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.team.fields.code_type_sector') }}</label>
                    <select class="form-control {{ $errors->has('code_type_sector') ? 'is-invalid' : '' }}" name="code_type_sector" id="code_type_sector" required>
                        <option value disabled {{ old('code_type_sector', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($sectors as $key => $label)
                            <option value="{{ $key }}" {{ ($school->code_type_sector ? $school->sector->id : old('code_type_sector')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.code_type_sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="latitude_north">{{ trans('cruds.team.fields.latitude_north') }}</label>
                    <input class="form-control {{ $errors->has('latitude_north') ? 'is-invalid' : '' }}" type="number" name="latitude_north" id="latitude_north" value="{{ old('latitude_north', $school->latitude_north) }}" step="0.01">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.latitude_north_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="longitude_east">{{ trans('cruds.team.fields.longitude_east') }}</label>
                    <input class="form-control {{ $errors->has('longitude_east') ? 'is-invalid' : '' }}" type="number" name="longitude_east" id="longitude_east" value="{{ old('longitude_east', $school->longitude_east) }}" step="0.01">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.longitude_east_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="ward">{{ trans('cruds.team.fields.ward') }}</label>
                    <input class="form-control {{ $errors->has('ward') ? 'is-invalid' : '' }}" type="text" name="ward" id="ward" value="{{ old('ward', $school->ward) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.ward_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="nearby_name_school">{{ trans('cruds.team.fields.nearby_name_school') }}</label>
                    <input class="form-control {{ $errors->has('nearby_name_school') ? 'is-invalid' : '' }}" type="text" name="nearby_name_school" id="nearby_name_school" value="{{ old('nearby_name_school', $school->nearby_name_school) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.nearby_name_school_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection