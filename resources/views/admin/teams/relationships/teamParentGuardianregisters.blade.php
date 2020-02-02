<div class="m-3">
    @can('parent_guardianregister_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.parent-guardianregisters.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.parentGuardianregister.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.parentGuardianregister.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-ParentGuardianregister">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.first_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.middle_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.phone_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.parentGuardianregister.fields.team') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parentGuardianregisters as $key => $parentGuardianregister)
                            <tr data-entry-id="{{ $parentGuardianregister->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $parentGuardianregister->id ?? '' }}
                                </td>
                                <td>
                                    {{ $parentGuardianregister->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $parentGuardianregister->middle_name ?? '' }}
                                </td>
                                <td>
                                    {{ $parentGuardianregister->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $parentGuardianregister->email ?? '' }}
                                </td>
                                <td>
                                    {{ $parentGuardianregister->phone_number ?? '' }}
                                </td>
                                <td>
                                    @foreach($parentGuardianregister->teams as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('parent_guardianregister_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.parent-guardianregisters.show', $parentGuardianregister->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('parent_guardianregister_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.parent-guardianregisters.edit', $parentGuardianregister->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('parent_guardianregister_delete')
                                        <form action="{{ route('admin.parent-guardianregisters.destroy', $parentGuardianregister->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('parent_guardianregister_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.parent-guardianregisters.massDestroy') }}",
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
  $('.datatable-ParentGuardianregister:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection