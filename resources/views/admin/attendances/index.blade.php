@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('cruds.attendance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      <form action="{{ route('admin.att.get.save') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
         @include('partials.filter.class')
          <div class="col-sm-3">
            <div class="form-group">
              <label for="date" class="control-label">Date</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input name="date" id="date" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <button class="btn btn-primary btn-fill-lmd radius-4 text-light bg-true-v" type="submit">
                  {{ trans('global.save') }}
              </button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover" id="datatable">
              <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
              </thead>
              
          </table>
        </div>
      </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
@parent
@if(!Auth::User()->is_headTeacher)
<script src="{{ asset('js/filter2.js') }}"></script>
@endif
<script type="text/javascript">
    window.datatable = $('#datatable').DataTable( {
        data: [],
        pageLength: 100,
        columns: [
            { title: "Name" },
            { title: "Admission Number" },
            { title: "Attendance Status Morninig" },
            { title: "Attendance Status Afternoon" },
            { title: "Late Status Y/N" },
            { title: "Notes" },
        ]
    });

    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
             var id = $(this).val();
             var school = $('select[name="school"]').val();

             if (id){
                $.ajax({
                    url: '/admin/att/get/'+school+'/'+id,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(){
                      $('#spinner').show();
                    },
                    success: function(data){
                      $('#spinner').hide();
                     console.log(data);

                     datatable.clear();
                     $.each(data, function(index, value) {
                      var remove = value.id;
                      datatable.row.add([
                          value.child_name + " " + value.middle_name + " " + value.last_name,
                          value.admission_number,
                          '<div class="form-group">'+
                            '<input type="hidden" value="'+remove+'" name="student_id[]">'+
                            '<label class="container">'+"Present"+
                              '<input type="radio" name="attendance_morning['+remove+']" value="1" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Absent"+
                              '<input type="radio" name="attendance_morning['+remove+']" value="0">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<label class="container">'+"Present"+
                              '<input type="radio" name="attendance_afternoon['+remove+']" value="1" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Absent"+
                              '<input type="radio" name="attendance_afternoon['+remove+']" value="0">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<label class="container">'+"No"+
                              '<input type="radio" name="late_status['+remove+']" value="0" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Yes"+
                              '<input type="radio" name="late_status['+remove+']" value="1">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<textarea name="notes['+remove+']" class="form-group" >'+
                                
                            '</textarea>'+
                          '</div>'
                          ]).draw();
                          

                      });

                    }
                });
             } else {
              datatable.clear();
                $('select[name="datatable"]').clear();
             }
        });
    });
    

</script>
@if(Auth::User()->is_headTeacher)
<script type="text/javascript">
    

    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
             var id = $(this).val();
             console.log("{{Auth::User()->school_id}}");
             if (id){
                $.ajax({
                    url: '/admin/attt/get/'+id,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(){
                      $('#spinner').show();
                    },
                    success: function(data){
                      $('#spinner').hide();
                     datatable.clear();
                     $.each(data, function(index, value) {
                      var remove = value.id;
                      datatable.row.add([
                          value.child_name + " " + value.middle_name + " " + value.last_name,
                          value.admission_number,
                          '<div class="form-group">'+
                            '<input type="hidden" value="'+remove+'" name="student_id[]">'+
                            '<label class="container">'+"Present"+
                              '<input type="radio" name="attendance_morning['+remove+']" value="1" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Absent"+
                              '<input type="radio" name="attendance_morning['+remove+']" value="0">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<label class="container">'+"Present"+
                              '<input type="radio" name="attendance_afternoon['+remove+']" value="1" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Absent"+
                              '<input type="radio" name="attendance_afternoon['+remove+']" value="0">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<label class="container">'+"No"+
                              '<input type="radio" name="late_status['+remove+']" value="0" required>'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+

                            '<label class="container">'+"Yes"+
                              '<input type="radio" name="late_status['+remove+']" value="1">'+
                              '<span class="checkmark">'+'</span>'+
                            '</label>'+
                          '</div>',
                          '<div class="form-group">'+
                            '<textarea name="notes['+remove+']" class="form-group" >'+
                                
                            '</textarea>'+
                          '</div>'
                          ]).draw();
                          

                      });

                    }
                });
             } else {
              datatable.clear();
              $('#datatable').empty();
                $('select[name="datatable"]').clear();
             }
        });
    });
</script>
@endif
@endsection