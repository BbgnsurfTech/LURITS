@extends('layouts.admin')
@section('content')
<div class="content">
    
@can('leave_create')
    <div class="content-header">
        @if(!Auth::User()->is_teacher)
        <a type="button" class="btn btn-primary" href="{{ route("admin.leave.create") }}" style="text-align: center;">Add Leave</a>
        @else
        <a type="button" class="btn btn-success col-lg-12" href="{{ route("admin.leave.create") }}" style="text-align: center;">Apply Leave</a>
        @endif
    </div>
@endcan
@if(!Auth::User()->is_teacher)
<div class="card">
    <div class="card-header">
        {{ 'Staff Leave' }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        @include('partials.filter.school')
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Leave" id="datatable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>
                            Staff ID
                        </th>
                        <th>
                            Number of Days
                        </th>
                        <th>
                            Contact Number
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
@endif
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('leave_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leave.massDestroy') }}",
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
  $('.datatable-Leave:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
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
                    url: "{{ route('admin.leave.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'staff_id', name: 'staff_id' },
                    { data: 'number_of_days', name: 'number_of_days' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'status', name: 'status' },
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
$('#datatable').DataTable({
    processing: true,
    serverSide: true,
    destroy: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.leave.getLeave') }}",
        
    },
    
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'staff_id', name: 'staff_id' },
        { data: 'number_of_days', name: 'number_of_days' },
        { data: 'contact_number', name: 'contact_number' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 50,
 });
</script>
@endif
@endsection