@extends('layouts.admin')
@section('content')
@can('school_create')
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-primary" href="{{ route("admin.schools.create") }}">
        {{ trans('global.add') }} {{ trans('cruds.team.title_singular') }}
      </a>
    </div>
  </div>
</section>
@endcan
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('cruds.team.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa)
        @include('partials.filter.school')
        @endif
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Team" id="datatable">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                      ID
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.pseudo_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.nemis_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.school_community') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.village_town') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.code_type_sector') }}
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('school_delete')
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

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa)
<script type="text/javascript">
      $(document).ready(function(){
        $('select[name="country"]').on('change', function(){
             var country = $(this).val();

             if (country){
                $.ajax({
                    url: '/admin/lga/fetchStates/'+country,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="state"]').empty();
                         $('select[name="state"]').prepend(
                                '<option disabled selected value="">'+ "Please Select" +'</option>'
                                );
                         $.each(data, function(key, value){
                            $('select[name="state"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="state"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="state"]').on('change', function(){
             var state = $(this).val();
             
             if (state){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+state,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="lga"]').empty();
                         $('select[name="lga"]').prepend(
                                '<option disabled selected value="">'+ "Please Select" +'</option>'
                                );
                         $.each(data, function(key, value){
                            $('select[name="lga"]').append(
                                '<option value="'+key+'">'+key+'-'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lga"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="lga"]').on('change', function(){
             var lga = $(this).val();

             if (lga){
                $.ajax({
                    url: '/admin/lga/fetchSectors/',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="school_sector"]').empty();
                         $('select[name="school_sector"]').prepend(
                                '<option disabled selected value="">'+ "Please Select" +'</option>'
                                );
                         $.each(data, function(key, value){
                            $('select[name="school_sector"]').append(
                                '<option value="'+value.id+'">'+ value.title +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="school_sector"]').empty();
             }
        });
    });

    $(document).ready(function(){
    $('select[name="school_sector"]').on('change', function(){
          var sector = $(this).val();
          var lga = $('select[name="lga"]').val();
         $('#datatable').DataTable({
          processing: true,
          serverSide: true,
          destroy: true,
          retrieve: false,
          aaSorting: [],
          ajax: {
              url: '/admin/lga/getSchools',
              data: { lga: lga, sector: sector },
          },
          
          columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'pseudo_code', name: 'pseudo_code' },
            { data: 'nemis_code', name: 'nemis_code' },
            { data: 'school_community', name: 'school_community' },
            { data: 'village_town', name: 'village_town' },
            { data: 'code_type_sector', name: 'code_type_sector' },
            { data: 'actions', name: '{{ trans('global.actions') }}' }
          ],
          order: [[ 1, 'desc' ]],
          pageLength: 100,
       });
    });
  });  
</script>
@else
<script type="text/javascript">
  $(function () {
    // datatable
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('admin.schools.getSchools') }}",
        columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'name', name: 'name' },
            { data: 'pseudo_code', name: 'pseudo_code' },
            { data: 'nemis_code', name: 'nemis_code' },
            { data: 'school_community', name: 'school_community' },
            { data: 'village_town', name: 'village_town' },
            { data: 'code_type_sector', name: 'code_type_sector' },
            { data: 'actions', name: '{{ trans('global.actions') }}' }
          ],
        order: [[ 1, 'desc' ]],
        pageLength: 100,
    });
  });
</script>
@endif

@endsection