<?php $__env->startSection('styles'); ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
<script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Facial Recognition/Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <div id="my_camera"></div>
          <div class="mt-4" id="results" ></div>
          <input type="text" name="f-id" id="f-id" value="" hidden="true">
          <input class="btn btn-primary mt-2" type=button value="Take Snapshot" onClick="take_snapshot()">
          <button class="btn btn-primary mt-2" name="take" id="take" disabled="true">verify</button>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-primary" href="<?php echo e(url("admin/staff-attendances/face-id")); ?>">
          Verify Face
      </a>
    </div>
  </div>
</section> -->
<section class="content">
<div class="card">
    <div class="card-header">
        Staff Attendance List
    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.t-att.get.save')); ?>" method="POST" autocomplete="off">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
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
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php endif; ?>
<?php if(Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/zeqa.js')); ?>"></script>
<?php endif; ?>
<script type="text/javascript">
    window.datatable = $('#datatable').DataTable( {
        data: [],
        pageLength: 100,
        columns: [
            { title: "Name" },
            { title: "Staff ID" },
            { title: "Attendance Status Morninig" },
            { title: "Attendance Status Afternoon" },
            { title: "Late Status Y/N" },
            { title: "Notes" },
            { title: "Action" },
        ]
    });

    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
             var id = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/t-att/get/'+id,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                      $('.spinner').hide();
                     datatable.clear();
                     $.each(data, function(index, value) {
                    var remove = value.id;
                    var apiid = value.api_id;
                    datatable.row.add([
                        value.first_name + " " + value.middle_name + " " + value.last_name,
                        value.staff_id,
                        '<div class="form-group">'+
                          '<input type="hidden" value="'+remove+'" name="student_id[]">'+
                          '<label class="container">'+"Present"+
                            '<input type="radio" name="attendance_status_morning['+remove+']" value="1" required>'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+

                          '<label class="container">'+"Absent"+
                            '<input type="radio" name="attendance_status_morning['+remove+']" value="0">'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+
                        '</div>',
                        '<div class="form-group">'+
                          '<label class="container">'+"Present"+
                            '<input type="radio" name="attendance_status_afternoon['+remove+']" value="1" required>'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+

                          '<label class="container">'+"Absent"+
                            '<input type="radio" name="attendance_status_afternoon['+remove+']" value="0">'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+
                        '</div>',
                        '<div class="form-group">'+
                          '<label class="container">'+"No"+
                            '<input type="radio" name="late_status_y_n['+remove+']" value="0" required>'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+

                          '<label class="container">'+"Yes"+
                            '<input type="radio" name="late_status_y_n['+remove+']" value="1">'+
                            '<span class="checkmark">'+'</span>'+
                          '</label>'+
                        '</div>',
                        '<div class="form-group">'+
                          '<textarea name="notes['+remove+']" class="form-group" >'+
                              
                          '</textarea>'+
                        '</div>',
                        '<div class="form-group">'+
                          '<a class="btn btn-primary" href="#" onClick="reply_click('+apiid+')" name="verifyface" id="verifyface">'+
                              'Verify Face' +
                          '</a>'+
                        '</div>'
                        ]).draw();
                        

                    });

                    }
                });
             } else {
                $('select[name="datatable"]').empty();
             }
        });
    });

    function reply_click(clicked_id)
    {    
      document.getElementById("f-id").value = clicked_id;
      $.ajax({
        url: '/admin/t-att/verify/'+clicked_id,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('.spinner').show();
        },
        success: function(data){
          $('.spinner').hide();
          console.log(data);
          if (data == 200) {
            $('#exampleModal').modal('show');
            $('.modal-title').html("Facial Recognition/Verification");
          }else if (data == 401) {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Staff face not registered',
            showConfirmButton: false,
            timer: 2000
          });
        } else {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Attendace has already been taken for today',
              showConfirmButton: false,
              timer: 2000
            });
          }
        },
      });
    }    

</script>
<?php if(Auth::User()->is_headTeacher): ?>
<script>
$(function () {
  $.ajax({
    url: '/admin/t-att/get/',
    type: 'GET',
    dataType: 'json',
    success: function(data){
     datatable.clear();
     $.each(data, function(index, value) {
    var remove = value.id;
    var apiid = value.api_id;
    datatable.row.add([
        value.first_name + " " + value.middle_name + " " + value.last_name,
        value.staff_id,
        '<div class="form-group">'+
          '<input type="hidden" value="'+remove+'" name="student_id[]">'+
          '<label class="container">'+"Present"+
            '<input type="radio" name="attendance_status_morning['+remove+']" value="1" required>'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+

          '<label class="container">'+"Absent"+
            '<input type="radio" name="attendance_status_morning['+remove+']" value="0">'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+
        '</div>',
        '<div class="form-group">'+
          '<label class="container">'+"Present"+
            '<input type="radio" name="attendance_status_afternoon['+remove+']" value="1" required>'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+

          '<label class="container">'+"Absent"+
            '<input type="radio" name="attendance_status_afternoon['+remove+']" value="0">'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+
        '</div>',
        '<div class="form-group">'+
          '<label class="container">'+"No"+
            '<input type="radio" name="late_status_y_n['+remove+']" value="0" required>'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+

          '<label class="container">'+"Yes"+
            '<input type="radio" name="late_status_y_n['+remove+']" value="1">'+
            '<span class="checkmark">'+'</span>'+
          '</label>'+
        '</div>',
        '<div class="form-group">'+
          '<textarea name="notes['+remove+']" class="form-group" >'+
              
          '</textarea>'+
        '</div>',
        '<div class="form-group">'+
          '<a class="btn btn-primary" href="#" onClick="reply_click('+apiid+')" name="verifyface" id="verifyface">'+
              'Verify Face' +
          '</a>'+
        '</div>'
        ]).draw();
        

    });

    }
});
});

function reply_click(clicked_id)
    {
      document.getElementById("f-id").value = clicked_id;
    $.ajax({
      url: '/admin/t-att/verify/'+clicked_id,
      type: 'GET',
      dataType: 'json',
      beforeSend: function () {
          $('.spinner').show();
      },
      success: function(data){
        $('.spinner').hide();
        console.log(data);
        if (data == 200) {
          $('#exampleModal').modal('show');
          $('.modal-title').html("Facial Recognition/Verification");
        } else if (data == 401) {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Staff face not registered',
            showConfirmButton: false,
            timer: 2000
          });
        } else {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Attendace has already been taken for today',
            showConfirmButton: false,
            timer: 2000
          });
        }
      },
    });
    }   
</script>
<?php endif; ?>
<script src="<?php echo e(asset('js/webcam.js')); ?>"></script>
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });
 Webcam.attach( '#my_camera' );

// <!-- Code to handle taking the snapshot and displaying it locally -->
function take_snapshot() {
 // take snapshot and get image data
 Webcam.snap( function(data_uri) {
  // display results in page
  document.getElementById('results').innerHTML = 
    '<img id="imageprev" src="'+data_uri+'"/>';
    document.getElementById("take").disabled = false;
  });
}
  
$(document).ready(function(){
    $('#take').on('click', function(){
        var img = document.getElementById("imageprev").src;
        var uApi = $('#f-id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            enctype: 'multipart/form-data',
            url: '/admin/face-api',
            method: "POST",
            data: { photo: img, userApi: uApi },
            beforeSend: function () {
                $('.spinner').show();
            },
            success: function (data) {
              $('.spinner').hide();
              console.log(data);
              if (data == 419) {
                Swal.fire({
                    title: 'Something went wrong!',
                    text: 'Please make sure you have a strong internet connection and try again, or Contact admistrator.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
              }
              if (data == 404) {
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Attendace has already been taken for today',
                  showConfirmButton: false,
                  timer: 2000
                });
              }
               if (data == 401) {
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Staff face not registered',
                  showConfirmButton: false,
                  timer: 2000
                });
              }
              if (data == 200) {
                  Swal.fire({
                      position: 'top-center',
                      icon: 'success',
                      title: 'Verified',
                      text: 'Attendance recorded successfully',
                      showConfirmButton: false,
                      timer: 2000
                  });
              } else if (data == 405) {
                  Swal.fire({
                      title: 'Face not Verified!',
                      text: 'Try again',
                      icon: 'error',
                      showConfirmButton: false,
                      timer: 2000
                  });
              }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/staff-attendance/create.blade.php ENDPATH**/ ?>