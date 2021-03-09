@extends('layouts.admin')
@section('content')
<div class="card height-auto">
    <div class="card-header">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.staffs.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            @can('staff_edit')
                <a class="btn btn-info" href="{{ route('admin.staffs.edit', $staff->id) }}">
                    {{ trans('global.edit') }}
                </a>
            @endcan
            @can('staff_delete')
            <form action="{{ route('admin.staffs.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
            </form>
            @endcan
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Staff Bio Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="@if($staff->staff_picture) {{ $staff->staff_picture->getUrl() }} @elseif ($staff->gender->title == "Male") /img/userImage.png @else /dist/img/employee.png @endif" width="100px" height="100px" style="border-radius: 50%;" alt="staff image">
                </div>     
            </div>
            <div class="col-md-4">
                <h6>School: {{ $staff->school->name ?? '' }}</h6>
                <h6>Staff ID: {{ $staff->lga_staff_id ?? '' }} </h6>
                <h6>First Name: {{ $staff->first_name ?? '' }}</h6>
                <h6>Middle Name: {{ $staff->middle_name ?? '' }}</h6>
                <h6>Last Name: {{ $staff->last_name ?? '' }}</h6>
                <h6>Gender: {{ $staff->gender->title ?? '' }}</h6>
            </div>
            <div class="col-md-4">
                <h6>Date of Birth: {{ $staff->date_of_birth ?? '' }}</h6>
                <h6>State of Origin: {{ $staff->state_origin->name_atlas_entity ?? '' }}</h6>
                <h6>LGA of Origin: {{ $staff->lga_origin->name_atlas_entity ?? '' }}</h6>
                <h6>Disability: {{ $staff->disabiliy_text ?? 'None' }}</h6>
                <h6>Email: {{ $staff->email ?? '' }}</h6>
                <h6>Phone Number: {{ $staff->phone_number ?? '' }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Staff Profile Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Type of Staff: {{ $staff->type_staff->title ?? ''}}</h6>
                <h6>Year of First Appointment: {{ $staff->year_first_appointment ?? ''}}</h6>
                <h6>Year of Present Appointment: {{ $staff->year_present_appointment ?? ''}}</h6>
                <h6>Year of Posting to School: {{ $staff->year_posting_to_school ?? ''}}</h6>
            </div>
            <div class="col-md-6">
                <h6>Grade Level/Step: {{ $staff->grade_step ?? '' }}</h6>
                <h6>Source of Salary: {{ $staff->salary_source->title ?? '' }}</h6>
                <h6>Present Status: {{ $staff->present_status->title ?? '' }}</h6>
                <h6>Academic Qualification: {{ $staff->academic_qualification->title ?? '' }}</h6>
                <h6>Teaching Type: {{ $staff->teaching_type->title ?? '' }}</h6>
            </div>
        </div>
    </div>
</div>
@if($staff->academic_qualification_id !== 1)
<div class="card height-auto">
    <div class="card-header">Staff Academic Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h6>Teaching Qualification: {{ $staff->teaching_qualification->title ?? '' }}</h6>
                <h6>Area of Specialization: {{ $staff->area_of_specialization->ds_subject_name ?? '' }}</h6>
                <h6>Subject of Qualification: {{ $staff->subject_of_qualification->ds_subject_name ?? '' }}</h6>
                <h6>Main Subject Taught: {{ $staff->subject_taught->ds_subject_name ?? '' }}</h6>
                <h6>Seminar/Workshop: {{ $staff->seminar_workshop->title ?? "No" }}</h6>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card dashboard-card-six">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title">
                            <h3>Staff Documents</h3>
                        </div>
                    </div>
                    <div class="notice-box-wrap">
                        <div class="notice-list">
                            @forelse($staff->staff_document as $key => $media)
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