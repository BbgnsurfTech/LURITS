@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.schoolClass.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.school-classes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-12">
                <label for="class_id">Class</label>
                <select class="form-control {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($ds_classes as $ds_class)
                        <option value="{{ $ds_class->dsClass[0]->id }}">{{ $ds_class->dsClass[0]->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="amr_id">Amr</label>
                <select class="form-control {{ $errors->has('amr_id') ? 'is-invalid' : '' }}" name="amr_id" id="amr_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($ds_arms as $ds_arm)
                        <option value="{{ $ds_arm->id }}">{{ $ds_arm->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="staff_id">Class Teacher</label>
                <select class="form-control {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}">
                            {{ $staff->first_name ?? '' }}
                            {{ $staff->middle_name ?? '' }}
                            {{ $staff->last_name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>



@endsection