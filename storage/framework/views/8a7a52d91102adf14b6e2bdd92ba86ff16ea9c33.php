<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income_create')): ?>
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <div class="ui-modal-box">
        <div class="modal-box">
          <!-- Modal trigger -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
            <?php echo e(trans('global.add')); ?> Income
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
                          <form class="new-added-form" method="POST" action="<?php echo e(route("admin.incomes.store")); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                              <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              <div class="col-12 form-group">
                                <label for="income_category_id"><?php echo e(trans('cruds.income.fields.income_category')); ?></label>
                                <select class="form-control select2 <?php echo e($errors->has('income_category') ? 'is-invalid' : ''); ?>" name="income_category_id" id="income_category_id">
                                    <?php $__currentLoopData = $income_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $income_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>" <?php echo e(old('income_category_id') == $id ? 'selected' : ''); ?>><?php echo e($income_category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.income.fields.income_category_helper')); ?></span>
                              </div>
                              <div class="col-12 form-group">
                                <label class="required" for="entry_date"><?php echo e(trans('cruds.income.fields.entry_date')); ?></label>
                                <input class="form-control date <?php echo e($errors->has('entry_date') ? 'is-invalid' : ''); ?>" type="text" name="entry_date" id="entry_date" value="<?php echo e(old('entry_date')); ?>" required>
                                <?php if($errors->has('')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.income.fields.entry_date_helper')); ?></span>
                              </div>
                              <div class="col-12 form-group">
                                <label class="required" for="amount"><?php echo e(trans('cruds.income.fields.amount')); ?></label>
                                <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="number" name="amount" id="amount" value="<?php echo e(old('amount')); ?>" step="0.01" required>
                                <?php if($errors->has('')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.income.fields.amount_helper')); ?></span>
                              </div>
                              <div class="col-12 form-group">
                                <label for="description"><?php echo e(trans('cruds.income.fields.description')); ?></label>
                                <input class="form-control <?php echo e($errors->has('description') ? 'is-invalid' : ''); ?>" type="text" name="description" id="description" value="<?php echo e(old('description', '')); ?>">
                                <?php if($errors->has('')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.income.fields.description_helper')); ?></span>
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
</section>
<?php endif; ?>
<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.income.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
      <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Income" id="datatable" style="width: 100%">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(trans('cruds.income.fields.id')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.income.fields.income_category')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.income.fields.entry_date')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.income.fields.amount')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.income.fields.description')); ?>

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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.incomes.massDestroy')); ?>",
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
  $('.datatable-Income:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<?php if(Auth::User()->is_zeqa || Auth::User()->is_lgea): ?>
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="lgaa"]').on('change', function(){
         var lga = $(this).val();

         if (lga){
            $.ajax({
                url: '/admin/lga/fetchSchools/'+lga,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="schooll"]').empty();
                     $.each(data, function(key, value){
                        $('select[name="schooll"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="schooll"]').empty();
         }
    });
});
$(document).ready(function(){
    $('select[name="schooll"]').on('change', function(){
        var school = $(this).val();

         $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            retrieve: false,
            aaSorting: [],
            ajax: {
                url: "<?php echo e(route('admin.incomes.index')); ?>",
                data: {
                school: school 
                },
            },
            
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'income_category_name', name: 'income_category.name' },
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
<?php endif; ?>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
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
                    url: "<?php echo e(route('admin.incomes.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'income_category_name', name: 'income_category.name' },
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
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/incomes/index.blade.php ENDPATH**/ ?>