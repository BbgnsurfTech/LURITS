@extends('layouts.admin')
@section('content')
@can('teacher_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.teachers.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.teacher.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Teacher', 'route' => 'admin.teachers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.teacher.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      @include('partials.filter')
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Teacher" id="datatable">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.phone_number') }}
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
@can('teacher_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teachers.massDestroy') }}",
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

  $('.datatable-Teacher').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

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
                    url: "{{ route('admin.teachers.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@endsection