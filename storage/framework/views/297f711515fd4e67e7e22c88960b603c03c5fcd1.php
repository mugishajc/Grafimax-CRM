<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        
                     Grafimax-CRM
                    </div>
                    <div class="card card-primary">
                        <div class="card-header"><h4><?php echo e(__('Login')); ?></h4></div>
                        <div class="card-body">
                            <?php echo e(Form::open(array('route'=>'login','method'=>'post','id'=>'loginForm','class'=> 'login-form' ))); ?>

                            <div class="form-group">
                                <?php echo e(Form::label('email','Email')); ?>

                                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))); ?>

                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <span class="invalid-email text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <?php echo e(Form::label('password','Password')); ?>

                                    <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Your Password')))); ?>

                                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-password text-danger" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo e(Form::submit(__('Login'),array('class'=>'btn btn-primary btn-lg btn-block','id'=>'saveBtn'))); ?>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="simple-footer">
                        <?php echo e(__('Copyright')); ?> &copy; Grafimax Ltd <?php echo e(date('Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/auth/login.blade.php ENDPATH**/ ?>