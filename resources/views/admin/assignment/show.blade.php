@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Assignment' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assignment.index') }}">
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
                            {{ $assignment -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Staff ID
                        </th>                        
                        <td>
                            {{ $assignment->staff_id }} 
                        </td>                                                
                    </tr>                    
                    <tr>
                        <th>
                            Term
                        </th>                        
                        <td>
                            {{ $assignment -> term  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Week
                        </th>                        
                        <td>
                            {{ $assignment -> week  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Class ID
                        </th>                        
                        <td>
                            {{ $assignment -> class_id  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Subject
                        </th>                        
                        <td>
                            {{ $assignment -> subject  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Topic
                        </th>                        
                        <td>
                            {{ $assignment -> topic  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Assignment
                        </th>                        
                        <td>
                            {{ $assignment -> assignment  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $assignment -> remark }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.assignment.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection