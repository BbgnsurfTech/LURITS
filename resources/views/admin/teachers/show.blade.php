@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.teacher.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teachers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @can('teacher_edit')
                    <a class="btn btn-xs btn-info" href="{{ route('admin.student-admissions.edit', $teacher->id) }}">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                @can('teacher_delete')
                <form action="{{ route('admin.student-admissions.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                </form>
                @endcan
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ 'Staff File Number' }}
                        </th>
                        <td>
                            {{ $teacher->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.id') }}
                        </th>
                        <td>
                            {{ $teacher->staff_file_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.first_name') }}
                        </th>
                        <td>
                            {{ $teacher->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $teacher->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.last_name') }}
                        </th>
                        <td>
                            {{ $teacher->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Date of Birth' }}
                        </th>
                        <td>
                            {{ $teacher->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Year of First Appointment' }}
                        </th>
                        <td>
                            {{ $teacher->first_appointment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Year of Present Appointment' }}
                        </th>
                        <td>
                            {{ $teacher->present_appointment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Year of Posting to School' }}
                        </th>
                        <td>
                            {{ $teacher->posting_to_school }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Grade Level/Step' }}
                        </th>
                        <td>
                            {{ $teacher->grade_step }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Gender' }}
                        </th>
                        <td>
                            {{ App\Teacher::GENDER_SELECT [$teacher->gender] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Type of Staff' }}
                        </th>
                        <td>
                            {{ App\Teacher::TYPE_OF_STAFF [$teacher->type_of_staff] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Source of Salary' }}
                        </th>
                        <td>
                            {{ App\Teacher::SOURCE_OF_SALARY [$teacher->source_of_salary] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Present' }}
                        </th>
                        <td>
                            {{ App\Teacher::PRESENT [$teacher->present] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Academic Qualification' }}
                        </th>
                        <td>
                            {{ App\Teacher::ACADEMIC_QUALIFICATION [$teacher->academic_qualification] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Teaching Qualification' }}
                        </th>
                        <td>
                            {{ App\Teacher::TEACHING_QUALIFICATION [$teacher->teaching_qualification] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Area of Specialization' }}
                        </th>
                        <td>
                            {{ $teacher->area_of_specialization }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Teaching Type' }}
                        </th>
                        <td>
                            {{ App\Teacher::TEACHING_TYPE [$teacher->teaching_type] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Subject of Qualification' }}
                        </th>
                        <td>
                            {{ $teacher->subject_of_qualification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Subject Taught' }}
                        </th>
                        <td>
                            {{ $teacher->subject_taught }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'School ID' }}
                        </th>
                        <td>
                            {{ $teacher->team_id }}
                        </td>
                    </tr>                    
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.email') }}
                        </th>
                        <td>
                            {{ $teacher->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $teacher->phone_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teachers.index') }}">
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
            <a class="nav-link" href="#admission_teacher_attendances" role="tab" data-toggle="tab">
                {{ trans('cruds.teacherAttendance.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="admission_teacher_attendances">
            @includeIf('admin.teachers.relationships.admissionTeacherAttendances', ['teacherAttendances' => $teacher->admissionTeacherAttendances])
        </div>
    </div>
</div>

@endsection