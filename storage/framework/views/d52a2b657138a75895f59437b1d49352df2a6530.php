<?php $__env->startSection('content'); ?>
<div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="<?php echo e(asset('img/logo2.png')); ?>" alt="logo">
                </div>
            <a href="<?php echo e(route('admin.home')); ?>">
                <?php echo e(trans('panel.site_title')); ?>

            </a>
            <p class="login-box-msg">
                <?php echo e(trans('global.login')); ?>

            </p>

            <?php if(session()->has('message')): ?>
                <p class="alert alert-info">
                    <?php echo e(session()->get('message')); ?>

                </p>
            <?php endif; ?>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="login-form">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" required autocomplete="email" autofocus placeholder="<?php echo e(trans('global.login_email')); ?>" name="email" value="<?php echo e(old('email', null)); ?>"><i class="far fa-envelope"></i>

                    <?php if($errors->has('email')): ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('email')); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required placeholder="<?php echo e(trans('global.login_password')); ?>"><i class="fas fa-lock"></i>

                    <?php if($errors->has('password')): ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('password')); ?>

                        </div>
                    <?php endif; ?>
                </div>


                <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember-me">
                            <label for="remember"><?php echo e(trans('global.remember_me')); ?></label>
                        </div>
                </div>
                    <!-- /.col -->
                <div class="form-group">
                    <button type="submit" class="btn-fill-xl radius-30 text-light shadow-orange-peel bg-orange-peel">
                            <?php echo e(trans('global.login')); ?>

                    </button>
                </div>
            </form>


            <?php if(Route::has('password.request')): ?>
                <p class="mb-1">
                    <a class="forgot-btn" href="<?php echo e(route('password.request')); ?>">
                        <?php echo e(trans('global.forgot_password')); ?>

                    </a>
                </p>
            <?php endif; ?>
            <p class="mb-1">

            </p>
        
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/auth/login.blade.php ENDPATH**/ ?>