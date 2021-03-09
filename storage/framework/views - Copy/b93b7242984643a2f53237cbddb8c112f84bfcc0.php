<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_create')): ?>
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-primary" href="<?php echo e(route("admin.student-admissions.create")); ?>">
      <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.studentAdmission.title_singular')); ?>

    </a>
  </div>
</div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('cruds.studentAdmission.title_singular')); ?> <?php echo e(trans('global.list')); ?>

        </div>

        <div class="card-body">
            <?php echo $__env->make('partials.filter.class', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-bordered table-striped table-hover datatable datatable-StudentAdmission" id="datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.child_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.middle_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.last_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.admission')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.address')); ?>

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
</div>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<?php if(!Auth::User()->is_headTeacher): ?>
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('studentAdmission_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.schools.massDestroy')); ?>",
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

$('.datatable-StudentAdmission').DataTable(dtButtons);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
<?php endif; ?>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<script src="<?php echo e(asset('js/filter2.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();
            var school = $('select[name="school"]').val();
            
             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "<?php echo e(route('admin.student-admissions.index')); ?>",
                    data: {
                        classs: classs,
                        school: school,
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<?php endif; ?>
<?php if(Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/zeqa.js')); ?>"></script>
<?php endif; ?>
<script>
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();
            var school = $('select[name="school"]').val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "<?php echo e(route('admin.student-admissions.index')); ?>",
                    data: {
                        classs: classs,
                        school: school,
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 100,
             });
        });
    });
</script>
<?php if(Auth::User()->is_lga): ?>
    <?php echo $__env->make('partials.isNew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(Auth::User()->is_headTeacher): ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classss"]').on('change', function(){
            var classss = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "<?php echo e(route('admin.student-admissions.getAdmission')); ?>",
                    data: {
                    classss: classss 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'child_name', name: 'child_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'admission', name: 'admission' },
                    { data: 'address', name: 'address' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.student-admissions.massDestroy')); ?>",
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
    pageLength: 50,
  });
  $('.datatable-StudentAdmission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/studentAdmissions/index.blade.php ENDPATH**/ ?>