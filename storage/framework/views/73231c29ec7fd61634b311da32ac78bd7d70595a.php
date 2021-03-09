<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('smr_create')): ?>
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-primary" href="<?php echo e(route("admin.smr.create")); ?>">
        <?php echo e(trans('global.add')); ?> <?php echo e('Staff Movement'); ?> <?php echo e('Record'); ?>

      </a>
    </div>
  </div>
</section>
<?php endif; ?>
<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e('Staff Movement Records'); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
         <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Smr" id="datatable" style="width: 100%;">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Contact Number
                        </th>
                        <th>
                            Purpose
                        </th>
                        <th>
                            Time out
                        </th>
                        <th>
                            Time Back
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
</section>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<?php if(!Auth::User()->is_headTeacher): ?>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('smr_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.assets.massDestroy')); ?>",
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
  $('.datatable-Smr:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
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
                    url: "<?php echo e(route('admin.smr.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'date', name: 'date' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'purpose', name: 'purpose' },
                    { data: 'time_out', name: 'time_out' },
                    { data: 'time_back', name: 'time_back' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
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
                    url: "<?php echo e(route('admin.smr.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'date', name: 'date' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'purpose', name: 'purpose' },
                    { data: 'time_out', name: 'time_out' },
                    { data: 'time_back', name: 'time_back' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<?php endif; ?>
<?php if(Auth::User()->is_headTeacher): ?>
<script>
$(function () {
    let dtOverrideGlobals = {
        processing: true,
        serverSide: true,
        retrieve: true,
        ajax: "<?php echo e(route('admin.smr.getSmr')); ?>",
        columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'date', name: 'date' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'purpose', name: 'purpose' },
            { data: 'time_out', name: 'time_out' },
            { data: 'time_back', name: 'time_back' },
            { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
        ],
        order: [[ 1, 'desc' ]],
        pageLength: 100,
    };
    $('.datatable-Smr').DataTable(dtOverrideGlobals);
});
// $(function () {
//   // DataTable
//   $('#datatable').DataTable({
//     processing: true,
//     serverSide: true,
//     destroy: true,
//     retrieve: false,
//     aaSorting: [],
//     ajax: "<?php echo e(route('admin.smr.getSmr')); ?>",
//     columns: [
//         { data: 'placeholder', name: 'placeholder' },
//         { data: 'date', name: 'date' },
//         { data: 'contact_number', name: 'contact_number' },
//         { data: 'purpose', name: 'purpose' },
//         { data: 'time_out', name: 'time_out' },
//         { data: 'time_back', name: 'time_back' },
//         { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
//     ],
//     order: [[ 1, 'desc' ]],
//     pageLength: 50,
//   });

// });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/smr/index.blade.php ENDPATH**/ ?>