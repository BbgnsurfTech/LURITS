@extends('layouts.admin')
@section('content')
@can('clubs_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
          <a class="btn btn-success" href="{{ route("admin.clubs.create") }}">
                {{ trans('global.add') }} {{ 'Record' }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ 'School Clubs/Societies Activities Records' }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('partials.filter')
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Clubs" id="datatable">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Club/Society Name
                        </th>
                        <th>
                            Activity
                        </th>
                        <th>
                            Venue of Meeting
                        </th>
                        <th>
                            Duration
                        </th>
                        <th>
                            Number of Participants
                        </th>
                        <th>
                            Resolution
                        </th>
                        <th>
                            Purpose
                        </th>
                        <th>
                            Remark
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('clubs_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clubs.massDestroy') }}",
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
  $('.datatable-Clubs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
                    url: "{{ route('admin.clubs.index') }}",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'term', name: 'term' },
                    { data: 'week', name: 'week' },
                    { data: 'topic', name: 'topic' },
                    { data: 'assignment', name: 'assignment' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
@endsection