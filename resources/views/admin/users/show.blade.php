@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $user->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <td>
                            {{ $user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.profile_img') }}
                        </th>
                        <td>
                            @if($user->profile_img)
                                <a href="{{ $user->profile_img->getUrl() }}" target="_blank">
                                    <img src="{{ $user->profile_img->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#assigned_to_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_assets" role="tab" data-toggle="tab">
                {{ trans('cruds.asset.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_user_assets_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsHistory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="assigned_to_tasks">
            @includeIf('admin.users.relationships.assignedToTasks', ['tasks' => $user->assignedToTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_assets">
            @includeIf('admin.users.relationships.assignedToAssets', ['assets' => $user->assignedToAssets])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_user_assets_histories">
            @includeIf('admin.users.relationships.assignedUserAssetsHistories', ['assetsHistories' => $user->assignedUserAssetsHistories])
        </div>
    </div>
</div>

@endsection