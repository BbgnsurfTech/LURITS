@extends('layouts.admin')
@section('content')
@can('teacher_attendance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.teacher-attendances.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.teacherAttendance.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'TeacherAttendance', 'route' => 'admin.teacher-attendances.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.teacherAttendance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TeacherAttendance">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.teacherAttendance.fields.admission') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacherAttendance.fields.attendance_status_morninig') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacherAttendance.fields.attendance_status_afternoon') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacherAttendance.fields.late_status_y_n') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('teacher_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teacher-attendances.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.teacher-attendances.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'teachers_first_name', name: 'teacher.first_name' },
{ data: 'teachers.middle_name', name: 'teachers.middle_name' },
{ data: 'teachers.last_name', name: 'teachers.last_name' },
{ data: 'teachers.phone_number', name: 'teachers.phone_number' },
{ data: 'attendance_status_morninig', name: 'attendance_status_morninig' },
{ data: 'attendance_status_afternoon', name: 'attendance_status_afternoon' },
{ data: 'late_status_y_n', name: 'late_status_y_n' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  };
  $('.datatable-TeacherAttendance').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection