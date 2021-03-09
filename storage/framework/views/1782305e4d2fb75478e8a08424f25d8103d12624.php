
<a href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo e($id); ?>" data-original-title="View"
   class="view btn btn-info btn-sm viewIncidence"><i class="fa fa-eye"></i>&nbspView Incidence</a>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('incidence_create')): ?>
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo e($id); ?>" data-original-title="Edit"
       class="edit btn btn-primary btn-sm editIncidence"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
<?php endif; ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/pages/incidencereporting/incidenceactions.blade.php ENDPATH**/ ?>