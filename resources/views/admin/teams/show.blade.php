@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.team.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.id') }}
                        </th>
                        <td>
                            {{ $team->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.name') }}
                        </th>
                        <td>
                            {{ $team->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.pseudo_code') }}
                        </th>
                        <td>
                            {{ $team->pseudo_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.nemis_code') }}
                        </th>
                        <td>
                            {{ $team->nemis_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.number_and_street') }}
                        </th>
                        <td>
                            {{ $team->number_and_street }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.school_community') }}
                        </th>
                        <td>
                            {{ $team->school_community }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.village_town') }}
                        </th>
                        <td>
                            {{ $team->village_town }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.email_address') }}
                        </th>
                        <td>
                            {{ $team->email_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.school_telephone') }}
                        </th>
                        <td>
                            {{ $team->school_telephone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.code_type_sector') }}
                        </th>
                        <td>
                            {{ App\Team::CODE_TYPE_SECTOR_SELECT[$team->code_type_sector] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.latitude_north') }}
                        </th>
                        <td>
                            {{ $team->latitude_north }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.longitude_east') }}
                        </th>
                        <td>
                            {{ $team->longitude_east }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.ward') }}
                        </th>
                        <td>
                            {{ $team->ward }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.nearby_name_school') }}
                        </th>
                        <td>
                            {{ $team->nearby_name_school }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.team') }}
                        </th>
                        <td>
                            {{ $team->team->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
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
            <a class="nav-link" href="#team_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#school_enrolled_student_admissions" role="tab" data-toggle="tab">
                {{ trans('cruds.studentAdmission.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_attendances" role="tab" data-toggle="tab">
                {{ trans('cruds.attendance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_teachers" role="tab" data-toggle="tab">
                {{ trans('cruds.teacher.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_teacher_attendances" role="tab" data-toggle="tab">
                {{ trans('cruds.teacherAttendance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_student_admissions" role="tab" data-toggle="tab">
                {{ trans('cruds.studentAdmission.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_task_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.taskStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_asset_locations" role="tab" data-toggle="tab">
                {{ trans('cruds.assetLocation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_assets" role="tab" data-toggle="tab">
                {{ trans('cruds.asset.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_assets_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team_parent_guardianregisters" role="tab" data-toggle="tab">
                {{ trans('cruds.parentGuardianregister.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="team_users">
            @includeIf('admin.teams.relationships.teamUsers', ['users' => $team->teamUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_teams">
            @includeIf('admin.teams.relationships.teamTeams', ['teams' => $team->teamTeams])
        </div>
        <div class="tab-pane" role="tabpanel" id="school_enrolled_student_admissions">
            @includeIf('admin.teams.relationships.schoolEnrolledStudentAdmissions', ['studentAdmissions' => $team->schoolEnrolledStudentAdmissions])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_attendances">
            @includeIf('admin.teams.relationships.teamAttendances', ['attendances' => $team->teamAttendances])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_teachers">
            @includeIf('admin.teams.relationships.teamTeachers', ['teachers' => $team->teamTeachers])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_teacher_attendances">
            @includeIf('admin.teams.relationships.teamTeacherAttendances', ['teacherAttendances' => $team->teamTeacherAttendances])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_student_admissions">
            @includeIf('admin.teams.relationships.teamStudentAdmissions', ['studentAdmissions' => $team->teamStudentAdmissions])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_task_statuses">
            @includeIf('admin.teams.relationships.teamTaskStatuses', ['taskStatuses' => $team->teamTaskStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_tasks">
            @includeIf('admin.teams.relationships.teamTasks', ['tasks' => $team->teamTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_asset_locations">
            @includeIf('admin.teams.relationships.teamAssetLocations', ['assetLocations' => $team->teamAssetLocations])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_assets">
            @includeIf('admin.teams.relationships.teamAssets', ['assets' => $team->teamAssets])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_assets_histories">
            @includeIf('admin.teams.relationships.teamAssetsHistories', ['assetsHistories' => $team->teamAssetsHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_contact_companies">
            @includeIf('admin.teams.relationships.teamContactCompanies', ['contactCompanies' => $team->teamContactCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_contact_contacts">
            @includeIf('admin.teams.relationships.teamContactContacts', ['contactContacts' => $team->teamContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_expenses">
            @includeIf('admin.teams.relationships.teamExpenses', ['expenses' => $team->teamExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_incomes">
            @includeIf('admin.teams.relationships.teamIncomes', ['incomes' => $team->teamIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="team_parent_guardianregisters">
            @includeIf('admin.teams.relationships.teamParentGuardianregisters', ['parentGuardianregisters' => $team->teamParentGuardianregisters])
        </div>
    </div>
</div>

@endsection