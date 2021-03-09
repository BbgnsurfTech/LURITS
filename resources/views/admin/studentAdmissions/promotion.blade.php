@extends('layouts.admin')
@section('content')
@can('promotion_create')
 <section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
      <div class="col-lg-12">
        <a class="btn btn-primary" href="{{ route("admin.promotion.create") }}">
              {{ trans('global.add') }} Promotion
          </a>
      </div>
  </div>
</section>
@endcan
<section class="content"><div class="card">
    <div class="card-header">
        Promotion {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('partials.filter.school')
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transfers" id="datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                          Student ID
                        </th>
                        <th>
                            Flow Type
                        </th>
                        <th>
                            Term
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>	</section>

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
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
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
                    url: "{{ route('admin.transfer.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'certificate_number', name: 'certificate_number' },
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
@endif
@endsection

@if(Auth::User()->is_new)
@can('transfer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
          <a class="btn btn-success" href="{{ route("admin.transfer.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.transfers.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transfers.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row">
          <div class="col-sm-2">
              <div class="form-group">
                  <label class="control-label">School</label>
                  <select name="school" class="form-control" id="school">
                      <option value="">Select School</option>
                      @foreach($school as $s)
                      <option value="{{ $s->id }}">{{ $s->name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
        </div>

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
                            Certificate No
                        </th>
                        <th>
                            Pupils Conduct
                        </th>
                        <th>
                            Reason for Leaving
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
                    { data: 'certificate_number', name: 'certificate_number' },
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
@endsection
@endif

@if(Auth::User()->is_teacher)
@can('transfer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
          <a class="btn btn-success" href="{{ route("admin.transfer.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.transfers.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transfers.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
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
                            Certificate No
                        </th>
                        <th>
                            Pupils Conduct
                        </th>
                        <th>
                            Reason for Leaving
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transfer_delete')
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
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    
    ajax: {
        url: "{{ route('admin.transfer.getTransfer') }}",
    },

    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'certificate_number', name: 'certificate_number' },
        { data: 'pupils_conduct', name: 'pupils_conduct' },
        { data: 'reason_for_leaving', name: 'reason_for_leaving' },
        { data: 'last_attendance_date', name: 'last_attendance_date' },
        { data: 'headteacher_name', name: 'headteacher_name' },
        { data: 'headteacher_phone', name: 'headteacher_phone' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  $('.datatable-Transfers').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection
@endif
@endsection