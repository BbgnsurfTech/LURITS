@extends('layouts.admin')
@section('content')
@can('student_admission_create')
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-primary" href="{{ route("admin.student-admissions.create") }}">
      {{ trans('global.add') }} {{ trans('cruds.studentAdmission.title_singular') }}
    </a>
  </div>
</div>
@endcan
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.studentAdmission.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            @include('partials.filter.class')
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-bordered table-striped table-hover datatable datatable-StudentAdmission" id="datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.studentAdmission.fields.child_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.studentAdmission.fields.middle_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.studentAdmission.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.studentAdmission.fields.admission') }}
                            </th>
                            <th>
                                {{ trans('cruds.studentAdmission.fields.address') }}
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
@section('scripts')
@parent
@if(!Auth::User()->is_headTeacher)
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('studentAdmission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.schools.massDestroy') }}",
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

$('.datatable-StudentAdmission').DataTable(dtButtons);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endif
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
<script src="{{ asset('js/filter2.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();
            var school = $('select[name="school"]').val();
            
             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.student-admissions.index') }}",
                    data: {
                        classs: classs,
                        school: school,
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@endif
@if(Auth::User()->is_zeqa)
<script src="{{ asset('js/zeqa.js') }}"></script>
@endif
<script>
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();
            var school = $('select[name="school"]').val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.student-admissions.index') }}",
                    data: {
                        classs: classs,
                        school: school,
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 100,
             });
        });
    });
</script>
@if(Auth::User()->is_lga)
    @include('partials.isNew')
@endif
@if(Auth::User()->is_headTeacher)
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classss"]').on('change', function(){
            var classss = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.student-admissions.getAdmission') }}",
                    data: {
                    classss: classss 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_admission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-admissions.massDestroy') }}",
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
  $('.datatable-StudentAdmission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endif
@endsection

@endsection