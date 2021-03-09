@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transfers.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transfer.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Certificate Number
                        </th>                        
                        <td>
                            {{ $transfer -> certificate_number }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Student
                        </th>                        
                        <td>
                            {{ $transfer->student->child_name }}
                            {{ $transfer->student->middle_name }}
                            {{ $transfer->student->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher Name
                        </th>                        
                        <td>
                            {{ $transfer -> headteacher_name  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher Phone
                        </th>                        
                        <td>
                            {{ $transfer -> headteacher_phone  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Transfer Status
                        </th>                        
                        <td>
                            {{ App\Transfer::TRANSFER_STATUS [$transfer->status]  }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.transfer.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection