<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile')); ?>

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
            <h1><?php echo e(__('Profile')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Profile')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-sidebar">
                            <div class="portlet light profile-sidebar-portlet ">
                                <div class="profile-userpic">
                                    <img alt="image" src="<?php echo e((!empty($userDetail->avatar))? $profile.'/'.$userDetail->avatar : $profile.'/avatar.png'); ?>" class="img-responsive user-profile" class="img-responsive user-profile">
                                </div>
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name font-style"> <?php echo e($userDetail->name); ?></div>
                                    <div class="profile-usertitle-job font-style"> <?php echo e($userDetail->type); ?></div>
                                    <div class="profile-usertitle-job"> <?php echo e($userDetail->email); ?></div>
                                </div>
                                <div class="profile-usermenu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <h4><?php echo e(__('Profile Account')); ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="setting-tab">
                                    <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#personal_info" role="tab" aria-controls="" aria-selected="true"><?php echo e(__('Personal Info')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#change_password" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Change Password')); ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade show active" id="personal_info" role="tabpanel" aria-labelledby="home-tab3">
                                            <?php echo e(Form::model($userDetail,array('route' => array('update.account'), 'method' => 'put', 'enctype' => "multipart/form-data"))); ?>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('name',__('Name'),array('class'=>'form-control-label'))); ?>

                                                        <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>_('Enter User Name')))); ?>

                                                        <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                                                        <span class="invalid-name" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo e(Form::label('email',__('Email'),array('class'=>'form-control-label'))); ?>

                                                    <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

                                                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                                    <span class="invalid-email" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""></div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                                        <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new"> <?php echo e(__('Select image')); ?> </span>
                                                                <span class="fileinput-exists"> <?php echo e(__('Change')); ?> </span>
                                                                <input type="hidden">
                                                                <input type="file" name="profile" id="logo">
                                                            </span>
                                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-right">
                                                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit account')): ?>
                                                        <?php echo e(Form::submit('Save Change',array('class'=>'btn btn-primary'))); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                        <div class="tab-pane fade" id="change_password" role="tabpanel" aria-labelledby="profile-tab3">
                                            <div class="company-setting-wrap">
                                                <?php echo e(Form::model($userDetail,array('route' => array('update.password',$userDetail->id), 'method' => 'put'))); ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('current_password',__('Current Password'),array('class'=>'form-control-label'))); ?>

                                                            <?php echo e(Form::password('current_password',null,array('class'=>'form-control','placeholder'=>_('Enter Current Password')))); ?>

                                                            <?php if ($errors->has('current_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('current_password'); ?>
                                                            <span class="invalid-current_password" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php echo e(Form::label('new_password',__('New Password'),array('class'=>'form-control-label'))); ?>

                                                        <?php echo e(Form::password('new_password',null,array('class'=>'form-control','placeholder'=>_('Enter New Password')))); ?>

                                                        <?php if ($errors->has('new_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('new_password'); ?>
                                                        <span class="invalid-new_password" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php echo e(Form::label('confirm_password',__('Re-type New Password'),array('class'=>'form-control-label'))); ?>

                                                        <?php echo e(Form::password('confirm_password',null,array('class'=>'form-control','placeholder'=>_('Enter Re-type New Password')))); ?>

                                                        <?php if ($errors->has('confirm_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('confirm_password'); ?>
                                                        <span class="invalid-confirm_password" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="col-lg-12 text-right">
                                                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                                                        <?php echo e(Form::submit('Save Change',array('class'=>'btn btn-primary'))); ?>

                                                    </div>
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
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/user/profile.blade.php ENDPATH**/ ?>