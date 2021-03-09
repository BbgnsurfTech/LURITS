@extends('layouts.admin')
@section('content')
@can('expense_category_create')
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <div class="ui-modal-box">
        <div class="modal-box">
          <!-- Modal trigger -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} Category
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
                          <form class="new-added-form" method="POST" action="{{ route("admin.expense-categories.store") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-12 form-group">
                                <label class="required" for="name">Name</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has(''))
                                    <span class="text-danger">{{ $errors->first('') }}</span>
                                @endif
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
@endcan
<section class="content">
  <div class="card">
    <div class="card-header">
        {{ trans('cruds.expenseCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ExpenseCategory" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.expenseCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.expenseCategory.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenseCategories as $key => $expenseCategory)
                        <tr data-entry-id="{{ $expenseCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $expenseCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $expenseCategory->name ?? '' }}
                            </td>
                            <td>
                                @can('expense_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.expense-categories.show', $expenseCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('expense_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.expense-categories.edit', $expenseCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('expense_category_delete')
                                    <form action="{{ route('admin.expense-categories.destroy', $expenseCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
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
@can('expense_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.expense-categories.massDestroy') }}",
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
  $('.datatable-ExpenseCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection