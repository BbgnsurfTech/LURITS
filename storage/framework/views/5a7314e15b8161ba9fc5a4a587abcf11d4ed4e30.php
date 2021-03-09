<?php $__env->startSection('content'); ?>
<div class="content">
    
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_create')): ?>
    <div class="content-header">
        <?php if(!Auth::User()->is_teacher): ?>
        <a type="button" class="btn btn-primary" href="<?php echo e(route("admin.leave.create")); ?>" style="text-align: center;">Add Leave</a>
        <?php else: ?>
        <a type="button" class="btn btn-success col-lg-12" href="<?php echo e(route("admin.leave.create")); ?>" style="text-align: center;">Apply Leave</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php if(!Auth::User()->is_teacher): ?>
<div class="card">
    <div class="card-header">
        <?php echo e('Staff Leave'); ?> <?php echo e(trans('global.list')); ?>

    </div>
    <div class="card-body">
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Leave" id="datatable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>
                            Staff ID
                        </th>
                        <th>
                            Number of Days
                        </th>
                        <th>
                            Contact Number
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            <?php echo e(trans('global.action')); ?>

                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.leave.massDestroy')); ?>",
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
  $('.datatable-Leave:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
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
                    url: "<?php echo e(route('admin.leave.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'staff_id', name: 'staff_id' },
                    { data: 'number_of_days', name: 'number_of_days' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<?php if(Auth::User()->is_headTeacher): ?>
<script>
$('#datatable').DataTable({
    processing: true,
    serverSide: true,
    destroy: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "<?php echo e(route('admin.leave.getLeave')); ?>",
        
    },
    
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'staff_id', name: 'staff_id' },
        { data: 'number_of_days', name: 'number_of_days' },
        { data: 'contact_number', name: 'contact_number' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 50,
 });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/leave/index.blade.php ENDPATH**/ ?>