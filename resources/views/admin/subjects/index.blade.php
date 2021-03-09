@extends('layouts.admin')
@section('content')
@if(Auth::User()->is_superAdmin)
@can('subject_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <div class="ui-modal-box">
          <div class="modal-box">
          <!-- Modal trigger -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} {{ trans('cruds.subjects.title_singular') }}
            </button>
            <!-- Add Subject Up Modal -->
              <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog"
              aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.subjects.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-12 form-group">
                <label class="required" for="subject">{{ trans('cruds.subjects.title_singular') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="ds_subject_name" id="subject" value="{{ old('ds_subject_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-12 form-group">
                <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                  <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}">{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
            </div>          
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
                    </div>
                  </div>
                </div>
              </div>
        
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Subjects', 'route' => 'admin.subjects.parseCsvImport']) 
        </div>
            </div>
          </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subjects.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      @include('partials.filter2')
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Subjects" id="datatable">
                <thead>
                    <tr >
                        <th>
                          ID
                        </th>
                        <th>
                            {{ trans('cruds.subjects.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.subjects.fields.action') }}
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
@can('subject_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subjects.massDestroy') }}",
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
  $('.datatable-Subjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<script src="{{ asset('js/filter2.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.subjects.index') }}",
                    data: {
                    classs: classs 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'ds_subject_name', name: 'ds_subject_name' },
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


@if(Auth::User()->is_new)
@can('subject_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <div class="ui-modal-box">
          <div class="modal-box">
          <!-- Modal trigger -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} {{ trans('cruds.subjects.title_singular') }}
            </button>
            <!-- Add Subject Up Modal -->
              <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog"
              aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.subjects.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-12 form-group">
                <label class="required" for="subject">{{ trans('cruds.subjects.title_singular') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="ds_subject_name" id="subject" value="{{ old('ds_subject_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-12 form-group">
                <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                  <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}">{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
            </div>          
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
                    </div>
                  </div>
                </div>
              </div>
        
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Subjects', 'route' => 'admin.subjects.parseCsvImport']) 
        </div>
            </div>
          </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subjects.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">School</label>
                    <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="classs">
                        <option value="">Select School</option>
                        @foreach($school as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
          </div>

          <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">Class</label>
                    <select name="classs" class="form-control input-lg dynamic" id="classs">
                        <option value="">Select Class</option>
                    </select>
                </div>
          </div>
        </div>

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Subjects" id="datatable">
                <thead>
                    <tr >
                        <th>
                          ID
                        </th>
                        <th>
                            {{ trans('cruds.subjects.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.subjects.fields.action') }}
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
@can('subject_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subjects.massDestroy') }}",
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
  $('.datatable-Subjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchClasss/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="classs"]').empty();
                            $('select[name="classs"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="classs"]').append(
                                '<option value="'+value.id+'">'+ value.class + " " + value.arms +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="classs"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.subjects.index') }}",
                    data: {
                    classs: classs 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'ds_subject_name', name: 'ds_subject_name' },
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
@can('subject_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <div class="ui-modal-box">
          <div class="modal-box">
          <!-- Modal trigger -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} {{ trans('cruds.subjects.title_singular') }}
            </button>
            <!-- Add Subject Up Modal -->
              <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog"
              aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.subjects.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-12 form-group">
                <label class="required" for="subject">{{ trans('cruds.subjects.title_singular') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="ds_subject_name" id="subject" value="{{ old('ds_subject_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-12 form-group">
                <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                  <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}">{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
            </div>          
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
                    </div>
                  </div>
                </div>
              </div>
        
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Subjects', 'route' => 'admin.subjects.parseCsvImport']) 
        </div>
            </div>
          </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subjects.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="classs">Class</label>
                    <select name="classs" id="classs">
                        <option value="" disabled selected>Please Select</option>
                        @foreach($classroom as $class)
                        <option value="{{ $class->id }}">{{ $class->class }} {{ $class->arms }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Subjects" id="datatable">
                <thead>
                    <tr>
                      <th>
                        
                      </th>  
                      <th>
                        ID
                      </th>
                      <th>
                          {{ trans('cruds.subjects.title_singular') }}
                      </th>
                      <th>
                          {{ trans('cruds.subjects.fields.action') }}
                      </th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.subjects.getSubject') }}",
                    data: {
                    classs: classs 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'ds_subject_name', name: 'ds_subject_name' },
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
@can('subject_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subjects.massDestroy') }}",
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
  $('.datatable-Subjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
@endif
@endsection