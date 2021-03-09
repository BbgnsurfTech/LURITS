@extends('layouts.admin')
@section('content')
<div class="card height-auto">
    <div class="card-header">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.student-admissions.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            @can('staff_edit')
                <a class="btn btn-info" href="{{ route('admin.student-admissions.edit', $studentAdmission->id) }}">
                    {{ trans('global.edit') }}
                </a>
            @endcan
            @can('staff_delete')
            <form action="{{ route('admin.student-admissions.destroy', $studentAdmission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
            </form>
            @endcan
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Student Bio Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="@if($studentAdmission->student_picture) {{ $studentAdmission->student_picture->getUrl() }} @else /dist/img/boxed-bg.jpg @endif" width="100px" height="100px" style="border-radius: 50%;" alt="Student image">
                </div>     
            </div>
            <div class="col-md-4">
                <h6>School: {{ $studentAdmission->school_enrolled->name ?? '' }}</h6>
                <h6>Admission Number: {{ $studentAdmission->admission_number ?? '' }} </h6>
                <h6>First Name: {{ $studentAdmission->child_name ?? '' }}</h6>
                <h6>Middle Name: {{ $studentAdmission->middle_name ?? '' }}</h6>
                <h6>Last Name: {{ $studentAdmission->last_name ?? '' }}</h6>
                <h6>Gender: {{ $studentAdmission->gender->title ?? '' }}</h6>
            </div>
            <div class="col-md-4">
                <h6>Date of Birth: {{ $studentAdmission->date_of_birth ?? '' }}</h6>
                <h6>Blood Group: {{ $studentAdmission->bloodgroup->title ?? '' }}</h6>
                <h6>Marital Status: {{ $studentAdmission->maritalstatus->title ?? '' }}</h6>
                <h6>Disability: {{ $studentAdmission->disabiliy_text ?? 'None' }}</h6>
                <h6>Hobby: {{ $studentAdmission->hobby ?? 'None' }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Parent/Guardian Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="@if($studentAdmission->parent_guardian->photo) {{config('app.url')}}/storage/images/parents/{{$studentAdmission->parent_guardian->photo}} @else /dist/img/boxed-bg.jpg @endif" width="100px" height="100px" style="border-radius: 50%;" alt="Parent image">
                </div>     
            </div>
            <div class="col-md-8">
                <h6>Parent/Guardian Name: 
                    {{ $studentAdmission->parent_guardian->first_name ?? '' }} {{ $studentAdmission->parent_guardian->middle_name ?? '' }} {{ $studentAdmission->parent_guardian->last_name ?? '' }}
                </h6>
                <h6>Phone Number: {{ $studentAdmission->parent_guardian->phone_number }}</h6>
                <h6>Address: {{ $studentAdmission->parent_guardian->address }}</h6>
                <h6>Profession: {{ $studentAdmission->parent_guardian->profession }}</h6>
                <h6>Income Status: N{{ $studentAdmission->parent_guardian->incomeStatus->title }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Student Profile Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h6>State of Origin: {{ $studentAdmission->state_origin->name_atlas_entity ?? '' }}</h6>
                <h6>LGA of Origin: {{ $studentAdmission->lga_origin->name_atlas_entity ?? '' }}</h6>
                <h6>Religion: {{ $studentAdmission->religion->title ?? '' }} </h6>
                <h6>Class: {{ $studentAdmission->classs->classTitle->title ?? '' }} {{ $studentAdmission->classs->armTitle->title ?? '' }}</h6>
                <h6>Address: {{ $studentAdmission->address ?? '' }}</h6>
            </div>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card dashboard-card-six">
            <div class="card-body">
                <div class="heading-layout1 mg-b-17">
                    <div class="item-title">
                        <h3>{{ trans('cruds.studentAdmission.fields.student_document') }}</h3>
                    </div>
                </div>
                <div class="notice-box-wrap">
                    <div class="notice-list">
                        @forelse($studentAdmission->student_document as $key => $media)
                            <ul>
                            <a href="{{ $media->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            </ul>
                        @empty
                        <strong>Not Available</strong>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection