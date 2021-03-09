@extends('layouts.admin')
@section('content')

                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.home") }}">Home</a>
                        </li>
                        <li>{{ trans('cruds.user.title_singular') }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user.store") }}" >
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                	<option value="" disabled selected>Please Select</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="teams">Schools</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('teams') ? 'is-invalid' : '' }}" name="teams[]" id="teams" multiple required>
                	<option value="" disabled selected>Please Select</option>
                    @foreach($teams as $teams)
                        <option value="{{ $teams->id }}" {{ in_array($teams->id, old('teams', [])) ? 'selected' : '' }}>{{ $teams->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('teams'))
                    <span class="text-danger">{{ $errors->first('teams') }}</span>
                @endif
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