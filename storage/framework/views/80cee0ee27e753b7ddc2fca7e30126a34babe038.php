<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parent_guardianregister_create')): ?>
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-success" href="<?php echo e(route("admin.parents.create")); ?>">
        <?php echo e(trans('global.add')); ?> Parent/Guardian
      </a>
    </div>
  </div>
<?php endif; ?>
<div class="card">
  <div class="card-header">
    <?php echo e(trans('cruds.parentGuardianregister.title_singular')); ?> <?php echo e(trans('global.list')); ?>

  </div>
  <div class="card-body">
    <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <table class="table table-bordered table-striped table-hover datatable datatable-ParentGuardianregister" id="datatable" style="width: 100%;">
      <thead>
        <tr>
          <th width="10">
          </th>
          <th>
              <?php echo e(trans('cruds.parentGuardianregister.fields.first_name')); ?>

          </th>
          <th>
              <?php echo e(trans('cruds.parentGuardianregister.fields.middle_name')); ?>

          </th>
          <th>
              <?php echo e(trans('cruds.parentGuardianregister.fields.last_name')); ?>

          </th>
          <th>
              <?php echo e(trans('cruds.parentGuardianregister.fields.email')); ?>

          </th>
          <th>
              <?php echo e(trans('cruds.parentGuardianregister.fields.phone_number')); ?>

          </th>
          <th>
              &nbsp;
          </th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parent_guardianregister_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.parents.massDestroy')); ?>",
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
    ajax: "<?php echo e(route('admin.parents.index')); ?>",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'first_name', name: 'first_name' },
      { data: 'middle_name', name: 'middle_name' },
      { data: 'last_name', name: 'last_name' },
      { data: 'email', name: 'email' },
      { data: 'phone_number', name: 'phone_number' },
      { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
    ],
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  };
  $('.datatable-ParentGuardianregister').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});

</script>
<script type="text/javascript">
$(document).ready(function(){
  $('select[name="school"]').on('change', function(){
    // alert("");
    var school = $(this).val();

    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      destroy: true,
      retrieve: false,
      aaSorting: [],
      ajax: {
          url: "<?php echo e(route('admin.parents.index')); ?>",
          data: {
          school: school 
          },
      },
      
      columns: [
        { data: 'placeholder', name: 'placeholder' },
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/parentGuardianregisters/index.blade.php ENDPATH**/ ?>