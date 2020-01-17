@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentAdmission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-admissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.child_name') }}
                        </th>
                        <td>
                            {{ $studentAdmission->child_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $studentAdmission->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.last_name') }}
                        </th>
                        <td>
                            {{ $studentAdmission->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.admission') }}
                        </th>
                        <td>
                            {{ $studentAdmission->admission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.gender') }}
                        </th>
                        <td>
                            {{ App\StudentAdmission::GENDER_SELECT[$studentAdmission->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.state_origin') }}
                        </th>
                        <td>
                            {{ App\StudentAdmission::STATE_ORIGIN_SELECT[$studentAdmission->state_origin] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.nationality_1') }}
                        </th>
                        <td>
                            {{ App\StudentAdmission::NATIONALITY_1_SELECT[$studentAdmission->nationality_1] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.hubby') }}
                        </th>
                        <td>
                            {{ $studentAdmission->hubby }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.student_picture') }}
                        </th>
                        <td>
                            @if($studentAdmission->student_picture)
                                <a href="{{ $studentAdmission->student_picture->getUrl() }}" target="_blank">
                                    <img src="{{ $studentAdmission->student_picture->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.student_document') }}
                        </th>
                        <td>
                            @foreach($studentAdmission->student_document as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.school_enrolled') }}
                        </th>
                        <td>
                            {{ $studentAdmission->school_enrolled->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-admissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#admission_attendances" role="tab" data-toggle="tab">
                {{ trans('cruds.attendance.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="admission_attendances">
            @includeIf('admin.studentAdmissions.relationships.admissionAttendances', ['attendances' => $studentAdmission->admissionAttendances])
        </div>
    </div>
</div>

@endsection