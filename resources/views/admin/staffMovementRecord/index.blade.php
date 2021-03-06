@extends('layouts.admin')
@section('content')
@can('smr_create')
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-success" href="{{ route("admin.smr.create") }}">
      {{ trans('global.add') }} {{ 'Staff Movement' }} {{ 'Record' }}
    </a>
  </div>
</div>
@endcan
<div class="container-fluid">  
  <div class="card">
    <div class="card-header">Staff Movement Records List</div>
    <div class="card-body">
      @include('partials.filter')
      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <table class="table table-bordered table-striped table-hover datatable datatable-Smr" id="datatable" style="width: 100%;">
          <thead>
            <tr>
              <th>
                ID
              </th>
              <th>
                Date
              </th>
              <th>
                Contact Number
              </th>
              <th>
                Purpose
              </th>
              <th>
                Time out
              </th>
              <th>
                Time Back
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
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('smr_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.smr.massDestroy') }}",
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
  $('.datatable-Smr:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<script src="{{ asset('js/filter.js') }}"></script>
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
                    url: "{{ route('admin.smr.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'purpose', name: 'purpose' },
                    { data: 'time_out', name: 'time_out' },
                    { data: 'time_back', name: 'time_back' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@endsection