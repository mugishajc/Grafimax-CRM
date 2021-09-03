<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pt-4">
                    <div class="changeLanguage float-right mr-1 position-relative">
                        <select name="language" id="language" class="form-control w-25 position-absolute selectric" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('register',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img class="img-fluid" src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt="image" width="">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header"><h4><?php echo e(__('Free Sign Up')); ?></h4></div>
                        <div class="card-body">
                            <?php echo e(Form::open(array('route'=>'register','method'=>'post','id'=>'loginForm'))); ?>

                            <div class="row">
                                <div class="form-group col-6">
                                    <?php echo e(Form::label('name','Name')); ?>

                                    <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Your Name')))); ?>

                                    <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                                    <span class="invalid-name text-danger" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                                <div class="form-group col-6">
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
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
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
                                <div class="form-group col-6">
                                    <?php echo e(Form::label('password_confirmation','Password Confirmation')); ?>

                                    <?php echo e(Form::password('password_confirmation',array('class'=>'form-control','placeholder'=>__('Enter Your Password')))); ?>

                                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-password_confirmation text-danger" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo e(Form::submit(__('Sign Up'),array('class'=>'btn btn-primary btn-lg btn-block','id'=>'saveBtn'))); ?>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        <?php echo e(__('Already Have Account?')); ?> <a href="<?php echo e(route('login')); ?>"><?php echo e(__('Log In')); ?></a>
                    </div>
                    <div class="simple-footer">
                        <?php echo e(__('Copyright')); ?> &copy; <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :config('app.name', 'Workgo')); ?> <?php echo e(date('Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/auth/register.blade.php ENDPATH**/ ?>