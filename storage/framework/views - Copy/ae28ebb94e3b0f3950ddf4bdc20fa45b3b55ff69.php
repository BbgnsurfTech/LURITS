<?php $__env->startSection('styles'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Parents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Parents</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="container-fluid">
                                <div class="row">
                                    <h3 class="card-title">List of Parents</h3>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parent_guardianregister_create')): ?>
                                    <button class="btn btn-primary ml-auto" id="createNewParent"><i class="fa fa-plus"></i>&nbsp;Create Parent</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dataTable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parent_guardianregister_create')): ?>
    <div class="modal fade" id="parentModel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="parentForm" name="parentForm" class="form-horizontal"
                              enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">                                
                                    <input type="hidden" name="parent_id" id="parent_id">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Passport</label>
                                        <div class="col-sm-12">
                                            <input id="photo" type="file" name="photo">
                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                        </div>
                                    </div>

                                    <img id="modal-preview" src="<?php echo e(asset('uploads/avatar.jpg')); ?>" alt="Preview"
                                     class="form-group hidden" width="100" height="100">

                                    <div class="form-group">
                                        <label for="firstName" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middleName" class="col-sm-12 control-label">Middle Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Enter Middle Name"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastName" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="income" class="col-sm-12 control-label">Annual Income</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="income" id="income" required>
                                                <option value="" disabled selected>Please Select</option>
                                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status->id); ?>"><?php echo e($status->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-6"> 
                                    <div class="form-group">
                                        <label for="email" class="col-sm-12 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="col-sm-12 control-label">Gender</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="gender" id="gender" required>
                                                <option value="" disabled selected>Select</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dateofbirth" class="col-sm-12 control-label">Date of Birth</label>
                                        <div class="col-sm-12">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" id="dateofbirth" name="dateofbirth" class="form-control datetimepicker-input" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-sm-12 control-label">Phone Number</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>                        
                                    <div class="form-group">
                                        <label for="address" class="col-sm-12 control-label">Address</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>                        
                                    <div class="form-group">
                                        <label for="profession" class="col-sm-12 control-label">Profession</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="profession" name="profession" placeholder="Enter Profession"
                                                value="" maxlength="50" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="alert alert-danger alert-dismissible" style="display: none">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" style="background: #1e7e34; color: white">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php endif; ?>

    
    <div class="modal fade" id="showParentModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parent/Guardian Profile</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div class="invoice p-3 mb-3" id="printArea">
              <!-- title row -->
              <div class="row">
              <div class="col-3" id="pict">
                </div>
                <!-- /.col -->                
                <div class="col-9">
                <h1 class="lead" id="name"></h1>
                    
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><h6 id="prof"></h6></li>
                        <li class="small"><h6 id="gen"></h6></li>
                        <li class="small"><h6 id="eml"></h6></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span><h6 id="add"></h6></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><h6 id="phn"></h6></li>
                      </ul>                
                </div>
                <!-- /.col -->
                </div>
              </div>
              <!-- info row -->
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <button class="btn btn-default" id="prt" onclick="printParent('printArea')"><i class="fas fa-print"></i>Print</button>
                </div>
              </div>
            </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- DataTables -->
    <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/pdfmake/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/pdfmake/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/jszip/jszip.min.js')); ?>"></script>
    
    <script type="text/javascript">
    $(function () { 

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         var table = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    aaSorting: [],
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    pageLength: 100,
                    dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: { url:"<?php echo e(route('admin.parents.index')); ?>"},
                    
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'photo', name: 'photo'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                        columnDefs: [
                    {
                        targets: 0,
                        className: 'noVis'
                    }
                    ],
                    buttons: [
                        {
                            extend: 'csv',
                            className: 'btn btn-default',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            exportOptions: {
                                columns: ':visible'
                            }
                    },
                        {
                            extend: 'excel',
                            className: 'btn btn-default',
                            text: '<i class="fa fa-file-excel"></i> Excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-default',
                            text: '<i class="fa fa-file-pdf"></i> PDF',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-default',
                            text: '<i class="fa fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            className: 'btn btn-default',
                            text: '<i class="fa fa-eye"></i> Column Visibility',
                            postfixButtons: [ 'colvisRestore' ],
                            columns: ':not(.noVis)'
                        }
                    ]
                });


        // create new parent
        $('#createNewParent').click(function () {
            $('#saveBtn').html("Create");
            $('#parent_id').val('');
            $('#parentForm').trigger("reset");
            $('.modal-title').html("Create New Parent");
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('#parentModel').modal('show');
            $('#modal-preview').attr('src', 'uploads/avatar.jpg');
        });

        // create or update parent
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');
            // Get form
            var form = $('#parentForm')[0];
            // Create an FormData object
            var formdata = new FormData(form);
            // disabled the submit button
            $("#saveBtn").prop("disabled", true);
            $.ajax({
                enctype: 'multipart/form-data',
                data: formdata,
                url: "<?php echo e(route('admin.parents.store')); ?>",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#parentForm').trigger("reset");
                    table.draw();
                    $('#saveBtn').html('Save');
                    if ($.isEmptyObject(data.errors)) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#parentModel').modal('hide');
                        // disabled the submit button
                        $("#saveBtn").prop("disabled", false);
                    } else {
                        $('.alert-danger').show();
                        $.each(data.errors, function (key, value) {
                            $('.alert-danger').append('<p class="mb-0">' + value + '</p>');
                        });
                        // disabled the submit button
                        $("#saveBtn").prop("disabled", false);
                    }
                }
            });
        });

        // edit parent
        $('body').on('click', '.editParent', function () {
            var parent_id = $(this).data('id');
             $.get("<?php echo e(url('admin/parents')); ?>" + '/' + parent_id + '/edit', function (data) {
                $('.modal-title').html("Edit Parent");
                $('#saveBtn').html('Update');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('#parentModel').modal('show');
                $('#parent_id').val(data.id);
                $('#firstName').val(data.first_name);
                $('#middleName').val(data.middle_name);
                $('#lastName').val(data.last_name);
                $('#email').val(data.email);
                $('#gender').val(data.gender_id);
                $('#income').val(data.income);
                $('#dateofbirth').datetimepicker('date', moment(data.date_of_birth, 'dd/mm/YYYY') );
                $('#phoneNumber').val(data.phone_number);
                $('#address').val(data.address);
                $('#profession').val(data.profession);
                $('#modal-preview').attr('alt', 'No image available');
                if (data.photo) {
                    $('#modal-preview').attr('src', 'uploads/parents/' + data.photo);
                    $('#hidden_image').val(data.photo);
                }

            })
        });

        //var myBookId = $(this).data('id');
        //$(".modal-body #bookId").val( myBookId );


        // show Parent
        $('body').on('click', '.viewParent', function () {
            var parentID = $(this).data('id');
             $.get("<?php echo e(url('admin/parents')); ?>" + '/' + parentID, function (data) {
                $('#showParentModel').modal('show');
                $('#parent_id').val(data.id);
                $('#pict').html('<img src="images/parents/'+data.photo+'" class="img-circle img-fluid" width="150" height="150" />');
                $('#name').html('<b>'+data.first_name+' '+data.last_name+'</b>');
                $('#prof').html('<b>Profession: </b>'+data.profession);
                $('#add').html('Address: '+data.address);
                $('#phn').html('<b>Phone #: </b>'+data.phone_number);
                $('#gen').html('<b>Gender: </b>'+data.gender.title);
                $('#eml').html('<b>Email: </b>'+data.email);
             })
        });


        // print Parent
        $('prt').on('click', '.viewParent', function () {
            var parentID = $(this).data('id');
            
             $.get("<?php echo e(url('admin/parents')); ?>" + '/' + parentID, function (data) {
                $('#showParentModel').modal('show');
                $('#parent_id').val(data.id);
                $('#pict').html('<img src="uploads/parents/'+data.photo+'" class="img-circle img-fluid" width="150" height="150" />');
                $('#name').html('<b>'+data.first_name+' '+data.last_name+'</b>');
                $('#prof').html('<b>Profession: </b>'+data.profession);
                $('#add').html('Address: '+data.address);
                $('#phn').html('<b>Phone #: </b>'+data.phone_number);
                $('#gen').html('<b>Gender: </b>'+data.gender);
                $('#eml').html('<b>Email: </b>'+data.email);
             })
        });



                // delete parent
                $('body').on('click', '.deleteParent', function () {
                    var parent_id = $(this).data("id");

                    Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "<?php echo e(url('admin/parents')); ?>" + '/' + parent_id,
                        success: function (data) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Parent Data has been deleted.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })

                });

});

function printParent(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/pages/manageparents.blade.php ENDPATH**/ ?>