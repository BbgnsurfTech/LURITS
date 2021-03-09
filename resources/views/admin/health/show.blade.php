@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Health Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.health.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Date
                        </th>                        
                        <td>
                            {{ $health -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Student ID
                        </th>                        
                        <td>
                            {{ $health -> student_id }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Type of Sickness/Illness
                        </th>                        
                        <td>
                            {{ $health -> type  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Prescription
                        </th>                        
                        <td>
                            {{ $health -> prescription  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cause of Sickness/Illness
                        </th>                        
                        <td>
                            {{ $health -> cause  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Follow-up Issues By
                        </th>                        
                        <td>
                            {{ $health -> followup  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher/Health Teachers Remark
                        </th>                        
                        <td>
                            {{ $health -> remark }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.health.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection