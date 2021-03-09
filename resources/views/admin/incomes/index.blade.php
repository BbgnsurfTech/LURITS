@extends('layouts.admin')
@section('content')

@can('income_create')
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <div class="ui-modal-box">
        <div class="modal-box">
          <!-- Modal trigger -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} Income
          </button>
              <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="close-btn">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <form class="new-added-form" method="POST" action="{{ route("admin.incomes.store") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              @include('partials.filter.school')
                              <div class="col-12 form-group">
                                <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                                <select class="form-control select2 {{ $errors->has('income_category') ? 'is-invalid' : '' }}" name="income_category_id" id="income_category_id">
                                    @foreach($income_categories as $id => $income_category)
                                        <option value="{{ $id }}" {{ old('income_category_id') == $id ? 'selected' : '' }}>{{ $income_category }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has(''))
                                    <span class="text-danger">{{ $errors->first('') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.income.fields.income_category_helper') }}</span>
                              </div>
                              <div class="col-12 form-group">
                                <label class="required" for="entry_date">{{ trans('cruds.income.fields.entry_date') }}</label>
                                <input class="form-control date {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required>
                                @if($errors->has(''))
                                    <span class="text-danger">{{ $errors->first('') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
                              </div>
                              <div class="col-12 form-group">
                                <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" required>
                                @if($errors->has(''))
                                    <span class="text-danger">{{ $errors->first('') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
                              </div>
                              <div class="col-12 form-group">
                                <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                                @if($errors->has(''))
                                    <span class="text-danger">{{ $errors->first('') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
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
        </div>
            </div>
          </div>
    </div>
</section>
</section>
@endcan
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('cruds.income.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      @include('partials.filter.school')
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Income" id="datatable">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.income.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.income.fields.income_category') }}
                    </th>
                    <th>
                        {{ trans('cruds.income.fields.entry_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.income.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.income.fields.description') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</section>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('income_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.incomes.massDestroy') }}",
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  $('.datatable-Staff:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@if(Auth::User()->is_zeqa || Auth::User()->is_lgea)
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="lgaa"]').on('change', function(){
         var lga = $(this).val();

         if (lga){
            $.ajax({
                url: '/admin/lga/fetchSchools/'+lga,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="schooll"]').empty();
                     $.each(data, function(key, value){
                        $('select[name="schooll"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="schooll"]').empty();
         }
    });
});
$(document).ready(function(){
    $('select[name="schooll"]').on('change', function(){
        var school = $(this).val();

         $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            retrieve: false,
            aaSorting: [],
            ajax: {
                url: "{{ route('admin.incomes.index') }}",
                data: {
                school: school 
                },
            },
            
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'income_category_name', name: 'income_category.name' },
                { data: 'entry_date', name: 'entry_date' },
                { data: 'amount', name: 'amount' },
                { data: 'description', name: 'description' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            order: [[ 1, 'desc' ]],
            pageLength: 50,
         });
    });
});
</script>
@endif
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
                    url: "{{ route('admin.incomes.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'income_category_name', name: 'income_category.name' },
                    { data: 'entry_date', name: 'entry_date' },
                    { data: 'amount', name: 'amount' },
                    { data: 'description', name: 'description' },
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
@endsection