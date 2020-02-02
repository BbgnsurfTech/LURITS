@extends('layouts.admin')
@section('content')
@can('student_admission_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.student-admissions.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.studentAdmission.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'StudentAdmission', 'route' => 'admin.student-admissions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentAdmission.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-StudentAdmission">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.child_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.middle_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.admission') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.state_origin') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.nationality_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.hubby') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.student_picture') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.student_document') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.school_enrolled') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentAdmission.fields.parent_guardian') }}
                        </th>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.middle_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.parentGuardianregister.fields.last_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentAdmissions as $key => $studentAdmission)
                        <tr data-entry-id="{{ $studentAdmission->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $studentAdmission->child_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->admission ?? '' }}
                            </td>
                            <td>
                                {{ App\StudentAdmission::GENDER_SELECT[$studentAdmission->gender] ?? '' }}
                            </td>
                            <td>
                                {{ App\StudentAdmission::STATE_ORIGIN_SELECT[$studentAdmission->state_origin] ?? '' }}
                            </td>
                            <td>
                                {{ App\StudentAdmission::NATIONALITY_1_SELECT[$studentAdmission->nationality_1] ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->hubby ?? '' }}
                            </td>
                            <td>
                                @if($studentAdmission->student_picture)
                                    <a href="{{ $studentAdmission->student_picture->getUrl() }}" target="_blank">
                                        <img src="{{ $studentAdmission->student_picture->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($studentAdmission->student_document as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $studentAdmission->school_enrolled->name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->parent_guardian->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->parent_guardian->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentAdmission->parent_guardian->last_name ?? '' }}
                            </td>
                            <td>
                                @can('student_admission_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.student-admissions.show', $studentAdmission->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('student_admission_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.student-admissions.edit', $studentAdmission->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_admission_delete')
                                    <form action="{{ route('admin.student-admissions.destroy', $studentAdmission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_admission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-admissions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  $('.datatable-StudentAdmission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection