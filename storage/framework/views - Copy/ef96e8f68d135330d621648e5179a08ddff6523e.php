<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.attendance.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.attendance.get.save')); ?>" method="POST" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="row">
         <?php echo $__env->make('partials.filter.class', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                  <?php echo e(trans('global.save')); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<?php if(!Auth::User()->is_headTeacher): ?>
<script src="<?php echo e(asset('js/filter2.js')); ?>"></script>
<?php endif; ?>
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
<?php if(Auth::User()->is_headTeacher): ?>
<script type="text/javascript">
    

    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
             var id = $(this).val();
             console.log("<?php echo e(Auth::User()->school_id); ?>");
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
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/attendances/index.blade.php ENDPATH**/ ?>