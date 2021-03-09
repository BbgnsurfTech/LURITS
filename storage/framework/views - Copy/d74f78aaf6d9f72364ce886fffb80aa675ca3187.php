<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category_create')): ?>
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <div class="ui-modal-box">
        <div class="modal-box">
          <!-- Modal trigger -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
            <?php echo e(trans('global.add')); ?> Category
          </button>
              <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="close-btn">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <form class="new-added-form" method="POST" action="<?php echo e(route("admin.asset-categories.store")); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                              <div class="col-12 form-group">
                                <label class="required" for="name">Name</label>
                                <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', '')); ?>" required>
                                <?php if($errors->has('')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                                <?php endif; ?>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <button class="btn btn-primary" type="submit">
                                    <?php echo e(trans('global.save')); ?>

                                </button>
                              </div>
                            </div>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
            </div>
          </div>
    </div>
</section>
<?php endif; ?>
<section class="content">
  <div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.assetCategory.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ExpenseCategory" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            <?php echo e(trans('cruds.assetCategory.fields.id')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.assetCategory.fields.name')); ?>

                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $assetCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $assetCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($assetCategory->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($assetCategory->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($assetCategory->name ?? ''); ?>

                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category_show')): ?>
                                    <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.asset-categories.show', $assetCategory->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category_edit')): ?>
                                    <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.asset-categories.edit', $assetCategory->id)); ?>">
                                        <?php echo e(trans('global.edit')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category_delete')): ?>
                                    <form action="<?php echo e(route('admin.asset-categories.destroy', $assetCategory->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                    </form>
                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_category_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.asset-categories.massDestroy')); ?>",
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
  $('.datatable-ExpenseCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/assetCategories/index.blade.php ENDPATH**/ ?>