@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Punishment' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.punishment.index') }}">
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
                            {{ $punishment -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Student ID
                        </th>                        
                        <td>
                            {{ $punishment -> student_id }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Age
                        </th>                        
                        <td>
                            {{ $punishment -> age  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Class
                        </th>                        
                        <td>
                            {{ App\Classroom::CLASS_SELECT [$punishment->class_id] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Offence
                        </th>                        
                        <td>
                            {{ $punishment -> offence  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Punishment
                        </th>                        
                        <td>
                            {{ $punishment -> punishment  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Punished By
                        </th>                        
                        <td>
                            {{ $punishment -> punished_by  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $punishment -> remark }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.punishment.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection