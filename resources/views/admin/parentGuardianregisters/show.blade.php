@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.parentGuardianregister.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parent-guardianregisters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.id') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.first_name') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.last_name') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.email') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $parentGuardianregister->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.team') }}
                        </th>
                        <td>
                            @foreach($parentGuardianregister->teams as $key => $team)
                                <span class="label label-info">{{ $team->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parent-guardianregisters.index') }}">
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
            <a class="nav-link" href="#parent_guardian_student_admissions" role="tab" data-toggle="tab">
                {{ trans('cruds.studentAdmission.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_guardian_student_admissions">
            @includeIf('admin.parentGuardianregisters.relationships.parentGuardianStudentAdmissions', ['studentAdmissions' => $parentGuardianregister->parentGuardianStudentAdmissions])
        </div>
    </div>
</div>

@endsection