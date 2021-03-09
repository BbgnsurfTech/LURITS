<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_create')): ?>
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="<?php echo e(route("admin.expenses.create")); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.expense.title_singular')); ?>

            </a>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="content">
  <div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.expense.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
      <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Expense" id="datatable" style="width: 100%">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(trans('cruds.expense.fields.id')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.expense.fields.expense_category')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.expense.fields.entry_date')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.expense.fields.amount')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.expense.fields.description')); ?>

                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</section>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.expenses.massDestroy')); ?>",
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-Expense:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
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
                    url: "<?php echo e(route('admin.expenses.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'expense_category_name', name: 'expense_category.name' },
                    { data: 'entry_date', name: 'entry_date' },
                    { data: 'amount', name: 'amount' },
                    { data: 'description', name: 'description' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'asc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/expenses/index.blade.php ENDPATH**/ ?>