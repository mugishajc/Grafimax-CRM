<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pt-4">
                    <div class="changeLanguage float-right mr-1 position-relative">
                        <select name="language" id="language" class="form-control w-25 position-absolute selectric" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('change.langPass',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img class="img-fluid" src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt="image" width="">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4><?php echo e(__('Forgot Password')); ?></h4></div>
                        <div class="card-body">
                            <p class="text-muted"><?php echo e(__('Enter your email address and we will send you an email with instructions to reset your password.')); ?></p>
                            <?php echo e(Form::open(array('route'=>'password.email','method'=>'post','id'=>'loginForm'))); ?>


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
                                <?php echo e(Form::submit(__(' Forgot Password'),array('class'=>'btn btn-primary btn-lg btn-block','id'=>'saveBtn'))); ?>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="simple-footer">
                        <?php echo e(__('Copyright')); ?> &copy; <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :config('app.name', 'Workgo')); ?> <?php echo e(date('Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>