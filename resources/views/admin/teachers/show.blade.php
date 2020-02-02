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
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.teacher.fields.id') }}
                        </th>
                        <td>
                            {{ $teacher->id }}
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