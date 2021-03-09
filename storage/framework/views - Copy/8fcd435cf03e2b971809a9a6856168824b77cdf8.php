<?php $__env->startSection('content'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Facial Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <div id="my_camera"></div>
          <div class="mt-4" id="results" ></div>
          <input class="btn btn-primary mt-2" type=button value="Take Snapshot" onClick="take_snapshot()">
          <button class="btn btn-primary mt-2" name="take" id="take" disabled="true">send</button>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="staffModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Staff Information</h3>
              </div>
              <div class="card-body">
                <div class="invoice p-3 mb-3" id="printArea">
                  <div class="row">
                    <div class="col-3" id="pict"></div>            
                      <div class="col-9">
                        <h1 class="lead" id="name"></h1>
                
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><h6 id="admission_number"></h6></li>
                              <li class="small"><h6 id="dob"></h6></li>
                              <li class="small"><h6 id="gender"></h6></li>
                              <li class="small"><h6 id="religion"></h6></li>
                              <li class="small"><h6 id="nationality"></h6></li>
                              <li class="small"><h6 id="state"></h6></li>
                              <li class="small"><h6 id="address"></h6></li><hr>
                          </ul>                
                      </div>
                    </div>
                  </div>
              </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_create')): ?>
        <a class="btn btn-primary" href="<?php echo e(route("admin.staffs.create")); ?>">
            Add Staff
        </a>
      <?php endif; ?>
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Verify Staff</button>
    </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      Staffs List
    </div>

    <div class="card-body">
      <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <table class="table table-bordered table-striped table-hover datatable datatable-Staff" id="datatable" style="width: 100%;">
          <thead>
              <tr>
                  <th width="10">

                  </th>
                  <th>
                      Staff ID
                  </th>
                  <th>
                      <?php echo e(trans('cruds.teacher.fields.first_name')); ?>

                  </th>
                  <th>
                      <?php echo e(trans('cruds.teacher.fields.middle_name')); ?>

                  </th>
                  <th>
                      <?php echo e(trans('cruds.teacher.fields.last_name')); ?>

                  </th>
                  <th>
                      <?php echo e(trans('cruds.teacher.fields.email')); ?>

                  </th>
                  <th>
                      <?php echo e(trans('cruds.teacher.fields.phone_number')); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<!-- Scripts -->
<?php if(!Auth::User()->is_headTeacher): ?>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staffs_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.staffs.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
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
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Staff:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php endif; ?>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php endif; ?>
<?php if(Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/zeqa.js')); ?>"></script>
<?php endif; ?>
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
                    url: "<?php echo e(route('admin.staffs.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'lga_staff_id', name: 'lga_staff_id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'asc' ]],
                pageLength: 100,
             });
        });
    });
</script>
<?php if(Auth::User()->is_headTeacher): ?>

<script type="text/javascript">
  
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.staffs.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
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
<?php endif; ?>

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    
    ajax: {
        url: "<?php echo e(route('admin.staffs.getStaff')); ?>",
    },
    
    columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'lga_staff_id', name: 'lga_staff_id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'middle_name', name: 'middle_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
        ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Staff').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

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
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            enctype: 'multipart/form-data',
            url: '/admin/face-verify',
            method: "POST",
            data: { photo: img },
            beforeSend: function () {
                // $('.spinner').show();
            },
            success: function (data) {
              // $('.spinner').hide();
              console.log(data.success);
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
                  title: 'Staff data not found',
                  showConfirmButton: false,
                  timer: 2000
                });
              }
              if (data.success == true) {
                  $('#exampleModal').hide();

                  var result = data.data;
                  console.log(result);

                  $('#pict').html('<img src="/storage/files/'+result.first_name+'" class="img-circle img-fluid" width="150" height="150" />');
                  $('#name').html('<b>'+result.first_name+" "+result.middle_name+" "+result.last_name+'</b>');
                  $('#admission_number').html('Staff ID:'+result.staff_id);
                  $('#dob').html('Date Of Birth: '+result.date_of_birth);
                  $('#gender').html('Gender: '+result.gender_id);
                  $('#religion').html('Religion: '+result.religion_id);
                  $('#nationality').html('Nationality: Nigerian');
                  $('#state').html('State of Origin: '+result.state);
                  $('#address').html('Address: '+result.address);
                  $('#parent').html('Name: '+result.parent);
                  $('#email').html('Email: '+result.email);
                  $('#phone_number').html('Phone Number: '+result.phone_number);
                  $('#parent_address').html('Address:'+result.parent_address);

                  $('#staffModal').modal('show');
              }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/staffs/index.blade.php ENDPATH**/ ?>