<?php $__env->startSection('styles'); ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?php echo e(asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">
<script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
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

<section class="content">
<div class="card">
    <div class="card-header">
        Staff Lesson Attendance
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="datatable">
            <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            
        </table>
      </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
window.datatable = $('#datatable').DataTable( {
    data: [],
    pageLength: 100,
    columns: [
        { title: "Name" },
        { title: "Staff ID" },
        { title: "Action" },
    ]
});

$(function () {
  $.ajax({
    url: '/admin/lesson/attendance/',
    type: 'GET',
    dataType: 'json',
    success: function(data){
      console.log(data);
     datatable.clear();
     $.each(data, function(index, value) {
      if (value.staff.middle_name == null) {
        var mName = '';
      } else {
        var mName = value.staff.middle_name;
      }
    var remove = value.id;
    var apiid = value.staff.api_id;
    datatable.row.add([
        value.staff.first_name + " " + mName + " " + value.staff.last_name,
        value.staff.staff_id,
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
    url: '/admin/lesson/attendance/'+clicked_id,
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
      } else {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Attendace has already been taken for this lesson',
          showConfirmButton: false,
          timer: 2000
        });
      }
    },
  });
}   
</script>
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
            url: '/admin/lesson/face',
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/attendances/lesson.blade.php ENDPATH**/ ?>