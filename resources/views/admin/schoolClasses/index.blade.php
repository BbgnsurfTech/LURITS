@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-primary" href="{{ route("admin.school-classes.create") }}">
            Add School Class
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        School Classes {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('partials.filter.school')
        <table class="table table-bordered table-striped table-hover datatable datatable-SchoolClass" id="datatable" style="width: 100%;">
            <thead>
                <tr style="background-color: #fab20f; color: #ffffff;">
                    <th></th>
                    <th>
                        Class
                    </th>
                    <th>
                        Arm
                    </th>
                    <th>
                        Staff ID
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
@can('school_class_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.school-classes.massDestroy') }}",
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
    pageLength: 100,
  });
  $('.datatable-SchoolClass:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="school"]').on('change', function(){
        // alert('');
        var school = $(this).val();

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            retrieve: false,
            aaSorting: [],
            ajax: {
                url: "{{ route('admin.school-classes.index') }}",
                data: {school: school},
            },
            columns: [
                {data: 'placeholder', name: 'placeholder', orderable: false, searchable: false},
                { data: 'class_id', name: 'classTitle.title'},
                { data: 'arm_id', name: 'armTitle.title'},
                { data: 'staff_id', name: 'staffData.staff_id'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
    });
});
</script>
@if(Auth::User()->is_headTeacher)
<script type="text/javascript">
   $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
// @can('staff_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.school-classes.massDestroy') }}",
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
// @endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    
    ajax: {
        url: "{{ route('admin.school-classes.index') }}",
    },
    
    columns: [
      {data: 'placeholder', name: 'placeholder', orderable: false, searchable: false},
      { data: 'class_id', name: 'classTitle.title'},
      { data: 'arm_id', name: 'armTitle.title'},
      { data: 'staff_id', name: 'staffData.staff_id'},
      {data: 'actions', name: 'actions', orderable: false, searchable: false},
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-SchoolClass').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endif
@endsection