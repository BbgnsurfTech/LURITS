@extends('layouts.admin')
@section('content')
@can('team_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.teams.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.team.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Team', 'route' => 'admin.teams.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.team.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Team">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.team.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.pseudo_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.nemis_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.school_community') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.village_town') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.code_type_sector') }}
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
@can('team_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teams.massDestroy') }}",
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
    ajax: "{{ route('admin.teams.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'pseudo_code', name: 'pseudo_code' },
{ data: 'nemis_code', name: 'nemis_code' },
{ data: 'school_community', name: 'school_community' },
{ data: 'village_town', name: 'village_town' },
{ data: 'code_type_sector', name: 'code_type_sector' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Team').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection