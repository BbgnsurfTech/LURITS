@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.leave-certificate-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @can('teacher_delete')
                <form action="{{ route('admin.leave-certificate-records.destroy', $leaveCertificateRecord->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                            Student ID
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> student_id }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Certificate Number
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> certificate_number }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Last Class Passed ID
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> last_class_passed_id  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Parent Guardian ID
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> parent_guardian_id  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Date of Graduation
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> date_of_graduation  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher Name
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> headteacher_name  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher Phone
                        </th>                        
                        <td>
                            {{ $leaveCertificateRecord -> headteacher_phone  }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.leave-certificate-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection