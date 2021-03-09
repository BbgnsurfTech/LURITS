@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="card">
        <div class="card-header">School Details</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>ID: {{ $school->id }}</h6>
                    <h6>Name: {{ $school->name ?? '' }} </h6>
                    <h6>{{ trans('cruds.team.fields.pseudo_code') }}: {{ $school->pseudo_code ?? '' }}</h6>
                    <h6>{{ trans('cruds.team.fields.nemis_code') }}: {{ $school->nemis_code ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.number_and_street') }}: {{ $school->number_and_street ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.school_community') }}: {{ $school->school_community ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.village_town') }}: {{ $school->village_town ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.email_address') }}: {{ $school->email_address ?? ''}}</h6>
                </div>
                <div class="col-md-6">
                    <h6>{{ trans('cruds.team.fields.school_telephone') }}: {{ $school->school_telephone ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.code_type_sector') }}: {{ $school->sector->title ?? '' }}</h6>
                    <h6>{{ trans('cruds.team.fields.latitude_north') }}: {{ $school->latitude_north ?? ''}}</h6>
                    <h6>{{ trans('cruds.team.fields.longitude_east') }}: {{ $school->longitude_east ?? ''}}</h6>
                    <h6>LGA: {{ $school->lga->atlas->name_atlas_entity ?? '' }}</h6>
                    <h6>{{ trans('cruds.team.fields.nearby_name_school') }}: {{ $school->nearby_name_school ?? '' }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">School Background</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Year of Establishment: {{ $school->background->year_establishment ?? ''}}</h6>
                    <h6>Location: {{ $school->background->schoolLocation->title ?? '' }}</h6>
                    <h6>Type of School: {{ $school->background->schoolType->title ?? '' }}</h6>
                    <h6>Shifts: {{ $school->background->shiftSystem->title ?? '' }}</h6>
                    <h6>Shared facilties: {{ $school->background->shareFacilities->title ?? '' }}</h6>
                    @if($school->shared_facility == 1)
                    <h6>Number of Shared Facilities: {{ $school->no_shared_facilities ?? '' }}</h6>
                    <h6>Facilties: {{ $school->shared_facilities ?? '' }}</h6>
                    @endif
                    <h6>Multi-grade Teaching: {{ $school->background->multigradeTeaching->title ?? '' }}</h6>
                    <h6>Average distance from Catchment Communities(KM): {{ $school->background->distance_from_community ?? '' }}</h6>
                    <h6>Distance from LGA (KM): {{ $school->background->distance_from_lga ?? '' }}</h6>
                    <h6>Distance from School: {{ $school->background->no_students_distance_to_school ?? '' }}</h6>
                    <h6>Students Boarding Male: {{ $school->background->no_students_boarding_male ?? '' }}</h6>
                    <h6>Students Boarding Female: {{ $school->background->no_students_boarding_female ?? '' }}</h6>
                    <h6>School Development Plan(SDP): {{ $school->background->sdpYesNo->title ?? '' }}</h6>
                    <h6>School Based Management Committee(SBMC): {{ $school->background->sbmcYesNo->title ?? '' }}</h6>
                </div>
                <div class="col-md-6">
                    <h6>Parent-Teacher Association (PTA): {{ $school->background->ptaYesNo->title ?? '' }}</h6>
                    <h6>Date of Last Inspection Visit: {{ $school->background->date_last_inspection ?? '' }}</h6>
                    <h6>Number of inspection Visit in last academic year: {{ $school->background->no_inspection ?? '' }}</h6>
                    <h6>Authority of Last Inspection: {{ $school->background->schoolAuthority->title ?? '' }}</h6>
                    <h6>Conditional Cash Transfer: {{ $school->background->conditional_cash_transfer ?? '' }}</h6>
                    <h6>School Grants: {{ $school->background->schoolGrants->title ?? '' }}</h6>
                    <h6>Security Guard: {{ $school->background->securityGuard->title ?? '' }}</h6>
                    <h6>Ownership: {{ $school->background->schoolOwnership->title ?? '' }}</h6>
                    <h6>Source of safe drinking water: {{ $school->background->waterSource->title ?? '' }}</h6>
                    <h6>Source of Electricity: {{ $school->background->shiftSystem->title ?? '' }}</h6>
                    <h6>Health Facility: {{ $school->background->shiftSystem->title ?? '' }}</h6>
                    <h6>Fence/Wall: {{ $school->background->shiftSystem->title ?? '' }}</h6>
                    <h6>Is there security situation that prevent school learners from learning in the last two months?: {{ $school->background->securityChallange->title ?? '' }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">School Facilities</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Toilets: </h6>
                    <h6>Computers: </h6>
                    <h6>Water Source(s): </h6>
                    <h6>Laboratories: </h6>
                    <h6>Classrooms: </h6>
                    <h6>Library: </h6>
                    <h6>Play Ground(s): </h6>
                    <h6>Wash Hand Facility: </h6>
                </div>
                <div class="col-md-4">
                   <h6>{{ $school->background->no_usable_toilets ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_computers ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_water_sources ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_laboratories ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_classrooms ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_libraries ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_play_grounds ?? '' }}</h6>
                   <h6>{{ $school->background->no_usable_hand_wash_facilities ?? '' }}</h6>
                </div>
                <div class="col-md-4">
                   <h6>{{ $school->background->no_unusable_toilets ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_computers ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_water_sources ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_laboratories ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_classrooms ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_libraries ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_play_grounds ?? '' }}</h6>
                   <h6>{{ $school->background->no_unusable_hand_wash_facilities ?? '' }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection