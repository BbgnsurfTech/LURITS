@extends('layouts.admin')
@section('content')
@can('student_transfer_create')
<section class="content-header">
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route("admin.transfer.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.transfers.title_singular') }}
            </a>
            @if(Auth::User()->is_headTeacher)
            <a class="btn btn-primary ml-2" href="{{ route("admin.transfer.request") }}">
                Request Transfer
            </a>
            @endif
        </div>
    </div>
</section>
@endcan
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transfers.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('partials.filter.school')
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transfers" id="datatable">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Reason for Leaving
                        </th>
                        <th>
                            Pupils Conduct
                        </th>
                        <th>
                            Last Attendance Date
                        </th>
                        <th>
                            Head Teacher Name
                        </th>
                        <th>
                            Head Teacher Phone
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
</section>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transfer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transfer.massDestroy') }}",
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
  $('.datatable-Transfers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa)
<script src="{{ asset('js/filter.js') }}"></script>
@endif
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.transfer.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'pupils_conduct', name: 'pupils_conduct' },
                    { data: 'reason_for_leaving', name: 'reason_for_leaving' },
                    { data: 'last_attendance_date', name: 'last_attendance_date' },
                    { data: 'headteacher_name', name: 'headteacher_name' },
                    { data: 'headteacher_phone', name: 'headteacher_phone' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@if(Auth::User()->is_headTeacher)
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transfer.massDestroy') }}",
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.transfer.getTransfer') }}",
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
  $('.datatable-Transfers').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});


  // $(function () {
  //   // datatable
  //   var table = $('#datatable').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       destroy: true,
  //       retrieve: true,
  //       aaSorting: [],
  //       ajax: "{{ route('admin.transfer.getTransfer') }}",
  //       columns: [
  //           { data: 'placeholder', name: 'placeholder' },
  //           { data: 'id', name: 'id' },
  //           { data: 'pupils_conduct', name: 'pupils_conduct' },
  //           { data: 'reason_for_leaving', name: 'reason_for_leaving' },
  //           { data: 'last_attendance_date', name: 'last_attendance_date' },
  //           { data: 'headteacher_name', name: 'headteacher_name' },
  //           { data: 'headteacher_phone', name: 'headteacher_phone' },
  //           { data: 'actions', name: '{{ trans('global.actions') }}' }
  //       ],
  //   });
  //   if (table) {console.log(table)}
  // });
</script>
@endif
@endsection
