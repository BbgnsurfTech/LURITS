@can('manage_subjects_edit')
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Edit"
       class="edit btn btn-primary btn-sm editSubject"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
@endcan
@can('manage_subjects_delete')
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Delete"
       class="btn btn-danger btn-sm deleteSubject"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>
@endcan
