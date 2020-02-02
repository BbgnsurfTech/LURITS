<div class="m-3">
    @can('teacher_attendance_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.teacher-attendances.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.teacherAttendance.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.teacherAttendance.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-TeacherAttendance">
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
                    <tbody>
                        @foreach($teacherAttendances as $key => $teacherAttendance)
                            <tr data-entry-id="{{ $teacherAttendance->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $teacherAttendance->admission->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $teacherAttendance->admission->middle_name ?? '' }}
                                </td>
                                <td>
                                    {{ $teacherAttendance->admission->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $teacherAttendance->admission->phone_number ?? '' }}
                                </td>
                                <td>
                                    {{ App\TeacherAttendance::ATTENDANCE_STATUS_MORNINIG_RADIO[$teacherAttendance->attendance_status_morninig] ?? '' }}
                                </td>
                                <td>
                                    {{ App\TeacherAttendance::ATTENDANCE_STATUS_AFTERNOON_RADIO[$teacherAttendance->attendance_status_afternoon] ?? '' }}
                                </td>
                                <td>
                                    {{ App\TeacherAttendance::LATE_STATUS_Y_N_RADIO[$teacherAttendance->late_status_y_n] ?? '' }}
                                </td>
                                <td>
                                    @can('teacher_attendance_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.teacher-attendances.show', $teacherAttendance->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('teacher_attendance_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.teacher-attendances.edit', $teacherAttendance->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('teacher_attendance_delete')
                                        <form action="{{ route('admin.teacher-attendances.destroy', $teacherAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('teacher_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teacher-attendances.massDestroy') }}",
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
  $('.datatable-TeacherAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection