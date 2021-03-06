@extends('layouts.admin')
@section('content')
@can('parent_guardianregister_create')
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-success" href="{{ route("admin.parents.create") }}">
        {{ trans('global.add') }} Parent/Guardian
      </a>
    </div>
  </div>
@endcan
<div class="card">
  <div class="card-header">
    {{ trans('cruds.parentGuardianregister.title_singular') }} {{ trans('global.list') }}
  </div>
  <div class="card-body">
    @include('partials.filter.school')
    <table class="table table-bordered table-striped table-hover datatable datatable-ParentGuardianregister" id="datatable" style="width: 100%;">
      <thead>
        <tr>
          <th width="10">
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
<script src="{{ asset('js/filter.js') }}"></script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('parent_guardianregister_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.parents.massDestroy') }}",
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

  // let dtOverrideGlobals = {
  //   buttons: dtButtons,
  //   processing: true,
  //   serverSide: true,
  //   retrieve: true,
  //   aaSorting: [],
  //   ajax: "{{ route('admin.parents.index') }}",
  //   columns: [
  //     { data: 'placeholder', name: 'placeholder' },
  //     { data: 'first_name', name: 'first_name' },
  //     { data: 'middle_name', name: 'middle_name' },
  //     { data: 'last_name', name: 'last_name' },
  //     { data: 'email', name: 'email' },
  //     { data: 'phone_number', name: 'phone_number' },
  //     { data: 'actions', name: '{{ trans('global.actions') }}' }
  //   ],
  //   order: [[ 1, 'asc' ]],
  //   pageLength: 50,
  // };
  $('.datatable-ParentGuardianregister').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});

</script>
<script type="text/javascript">
$(document).ready(function(){
  $('select[name="school"]').on('change', function(){
    // alert("");
    var school = $(this).val();

    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      destroy: true,
      retrieve: false,
      aaSorting: [],
      ajax: {
          url: "{{ route('admin.parents.index') }}",
          data: {
          school: school 
          },
      },
      
      columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'first_name', name: 'first_name' },
        { data: 'middle_name', name: 'middle_name' },
        { data: 'last_name', name: 'last_name' },
        { data: 'email', name: 'email' },
        { data: 'phone_number', name: 'phone_number' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
      ],
      order: [[ 1, 'desc' ]],
      pageLength: 100,
    });
  });
});
</script>
@endsection