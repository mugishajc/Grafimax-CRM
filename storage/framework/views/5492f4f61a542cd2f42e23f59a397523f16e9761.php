<?php
    $profile=asset(Storage::url('avatar/'));
    $logo=asset(Storage::url('logo/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link href="<?php echo e(asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Settings')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Settings')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Settings')); ?></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="setting-tab">
                            <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="contact-tab4" data-toggle="tab" href="#site-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Site Setting')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#email-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Email Setting')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#stripe-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Stripe Setting')); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade fade show active" id="site-setting" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="company-setting-wrap">
                                        <?php echo e(Form::open(array('url'=>'systems','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="font-weight-bold"> <?php echo e(__('Favicon')); ?> </p>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" alt=""></div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail fpreview"></div>
                                                            <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new"> <?php echo e(__('Select image')); ?> </span>
                                                                <span class="fileinput-exists"> <?php echo e(__('Change')); ?> </span>
                                                                <input type="hidden">
                                                                <input type="file" name="favicon" id="favicon">
                                                            </span>
                                                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> <?php echo e(__('Remove')); ?> </a>
                                                            </div>
                                                            <?php if ($errors->has('favicon')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('favicon'); ?>
                                                            <span class="invalid-favicon" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="font-weight-bold"> <?php echo e(__('Small Logo')); ?> </p>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?php echo e(asset(Storage::url('logo/small-logo.png'))); ?>" alt=""></div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail fpreview"></div>
                                                            <div>
                                                                <span class="btn btn-primary btn-file">
                                                                    <span class="fileinput-new"> <?php echo e(__('Select image')); ?> </span>
                                                                    <span class="fileinput-exists"> <?php echo e(__('Change')); ?> </span>
                                                                    <input type="hidden">
                                                                    <input type="file" name="small_logo" id="small_logo">
                                                                </span>
                                                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> <?php echo e(__('Remove')); ?> </a>
                                                            </div>
                                                            <?php if ($errors->has('small_logo')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('small_logo'); ?>
                                                            <span class="invalid-small_logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="font-weight-bold"> <?php echo e(__('Logo')); ?> </p>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt=""></div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail fpreview"></div>
                                                            <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new"> <?php echo e(__('Select image')); ?> </span>
                                                                <span class="fileinput-exists"> <?php echo e(__('Change')); ?> </span>
                                                                <input type="hidden">
                                                                <input type="file" name="logo" id="logo">
                                                            </span>
                                                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> <?php echo e(__('Remove')); ?> </a>
                                                            </div>
                                                            <?php if ($errors->has('logo')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('logo'); ?>
                                                            <span class="invalid-logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pt-5">
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('header_text',__('Title Text'))); ?>

                                                        <?php echo e(Form::text('header_text',Utility::getValByName('header_text'),array('class'=>'form-control','placeholder'=>__('Enter Header Title Text')))); ?>

                                                        <?php if ($errors->has('header_text')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('header_text'); ?>
                                                        <span class="invalid-header_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('footer_text',__('Footer Text'))); ?>

                                                        <?php echo e(Form::text('footer_text',Utility::getValByName('footer_text'),array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))); ?>

                                                        <?php if ($errors->has('footer_text')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('footer_text'); ?>
                                                        <span class="invalid-footer_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <?php echo e(Form::submit(__('Save Change'),array('class'=>'btn btn-primary'))); ?>

                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="email-setting" role="tabpanel" aria-labelledby="contact-tab4">
                                    <div class="email-setting-wrap">
                                        <?php echo e(Form::open(array('route'=>'email.settings','method'=>'post'))); ?>

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_driver',__('Mail Driver'))); ?>

                                                <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))); ?>

                                                <?php if ($errors->has('mail_driver')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_driver'); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_host',__('Mail Host'))); ?>

                                                <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))); ?>

                                                <?php if ($errors->has('mail_host')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_host'); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_port',__('Mail Port'))); ?>

                                                <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))); ?>

                                                <?php if ($errors->has('mail_port')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_port'); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_username',__('Mail Username'))); ?>

                                                <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))); ?>

                                                <?php if ($errors->has('mail_username')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_username'); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_password',__('Mail Password'))); ?>

                                                <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))); ?>

                                                <?php if ($errors->has('mail_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_password'); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_encryption',__('Mail Encryption'))); ?>

                                                <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                                <?php if ($errors->has('mail_encryption')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_encryption'); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_from_address',__('Mail From Address'))); ?>

                                                <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                                <?php if ($errors->has('mail_from_address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_from_address'); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('mail_from_name',__('Mail From Name'))); ?>

                                                <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                                <?php if ($errors->has('mail_from_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mail_from_name'); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <?php echo e(Form::submit(__('Save Change'),array('class'=>'btn btn-primary'))); ?>

                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="stripe-setting" role="tabpanel" aria-labelledby="contact-tab4">
                                    <div class="stripe-setting-wrap">
                                        <?php echo e(Form::open(array('route'=>'stripe.settings','method'=>'post'))); ?>


                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('stripe_key',__('Stripe Key'))); ?>

                                                <?php echo e(Form::text('stripe_key',env('STRIPE_KEY'),array('class'=>'form-control','placeholder'=>__('Enter Stripe Key')))); ?>

                                                <?php if ($errors->has('stripe_key')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stripe_key'); ?>
                                                <span class="invalid-stripe_key" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('stripe_secret',__('Stripe Secret'))); ?>

                                                <?php echo e(Form::text('stripe_secret',env('STRIPE_SECRET'),array('class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')))); ?>

                                                <?php if ($errors->has('stripe_secret')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stripe_secret'); ?>
                                                <span class="invalid-stripe_secret" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <?php echo e(Form::submit(__('Save Change'),array('class'=>'btn btn-primary'))); ?>

                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/settings/index.blade.php ENDPATH**/ ?>