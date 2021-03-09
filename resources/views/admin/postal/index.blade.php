@extends('layouts.admin')
@section('content')
@can('postal_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <div class="ui-modal-box">
          <div class="modal-box">
          <!-- Modal trigger -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">
            {{ trans('global.add') }} {{ 'Record' }}
            </button>
            <!-- Add Postal Modal -->
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
        <form class="new-added-form" method="POST" action="{{ route("admin.postal.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-12 form-group">
               <label for="date" class='required'>Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom left' autocomplete="off" required>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-12 form-group">
                <label class="required" for="status">{{ 'Status' }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>              
                    <option value="" disabled selected>Please Select</option>      
                    @foreach(App\Postal::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-12 form-group">
                <label class="required" for="description">{{ 'Description' }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-12 form-group">
                <label class="required" for="address">{{ 'Address' }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>    
            <div class="col-12 form-group">
                <label for="notes">{{ 'Notes' }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-12 form-group">
                <label for="remark">{{ 'Remark' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-danger" type="submit">
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
@endcan
<div class="card">
    <div class="card-header">
        {{ 'Postal' }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('partials.filter')
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Postal" id="datatable">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Notes
                        </th>
                        <th>
                            Remark
                        </th>
                        <th>
                          &nsbn;
                        </th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('postal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.postal.massDestroy') }}",
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
  $('.datatable-Postal:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
                    url: "{{ route('admin.postal.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'description', name: 'description' },
                    { data: 'address', name: 'address' },
                    { data: 'notes', name: 'notes' },
                    { data: 'remark', name: 'remark' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@endsection