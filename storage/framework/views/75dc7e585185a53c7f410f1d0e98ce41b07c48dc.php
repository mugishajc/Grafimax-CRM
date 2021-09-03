<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
                                    <a class="nav-link active" id="contact-tab4" data-toggle="tab" href="#system-setting" role="tab" aria-controls="" aria-selected="false">System Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#company-setting" role="tab" aria-controls="" aria-selected="false">Company Setting</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade fade show active" id="system-setting" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="company-setting-wrap">
                                        <?php echo e(Form::model($settings,array('route'=>'system.settings','method'=>'post'))); ?>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('site_currency',__('Currency *'))); ?>

                                                    <?php echo e(Form::text('site_currency',null,array('class'=>'form-control font-style'))); ?>

                                                    <?php if ($errors->has('site_currency')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('site_currency'); ?>
                                                    <span class="invalid-site_currency" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('site_currency_symbol',__('Currency Symbol *'))); ?>

                                                    <?php echo e(Form::text('site_currency_symbol',null,array('class'=>'form-control'))); ?>

                                                    <?php if ($errors->has('site_currency_symbol')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('site_currency_symbol'); ?>
                                                    <span class="invalid-site_currency_symbol" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-radio mb-3">

                                                                    <input type="radio" id="customRadio5" name="site_currency_symbol_position" value="pre" class="custom-control-input" <?php if(@$settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                                                    <label class="custom-control-label" for="customRadio5"><?php echo e(__('Pre')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-radio mb-3">
                                                                    <input type="radio" id="customRadio6" name="site_currency_symbol_position" value="post" class="custom-control-input" <?php if(@$settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                                                    <label class="custom-control-label" for="customRadio6"><?php echo e(__('Post')); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="site_date_format" class="form-control-label"><?php echo e(__('Date Format')); ?></label>
                                                    <select type="text" name="site_date_format" class="form-control selectric" id="site_date_format">
                                                        <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                                                        <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>d-m-y</option>
                                                        <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>m-d-y</option>
                                                        <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>y-m-d</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="site_time_format" class="form-control-label"><?php echo e(__('Time Format')); ?></label>
                                                    <select type="text" name="site_time_format" class="form-control selectric" id="site_time_format">
                                                        <option value="g:i A" <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                                        <option value="g:i a" <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm</option>
                                                        <option value="H:i" <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('invoice_prefix',__('Invoice Prefix'))); ?>

                                                    <?php echo e(Form::text('invoice_prefix',null,array('class'=>'form-control'))); ?>

                                                    <?php if ($errors->has('invoice_prefix')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('invoice_prefix'); ?>
                                                    <span class="invalid-invoice_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('bug_prefix',__('Bug Prefix'))); ?>

                                                    <?php echo e(Form::text('bug_prefix',null,array('class'=>'form-control'))); ?>

                                                    <?php if ($errors->has('bug_prefix')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('bug_prefix'); ?>
                                                    <span class="invalid-bug_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('invoice_title',__('Invoice Footer Title'))); ?>

                                                    <?php echo e(Form::text('invoice_title',null,array('class'=>'form-control'))); ?>

                                                    <?php if ($errors->has('invoice_title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('invoice_title'); ?>
                                                    <span class="invalid-bug_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('invoice_text',__('Invoice Footer Text'))); ?>

                                                    <?php echo e(Form::text('invoice_text',null,array('class'=>'form-control'))); ?>

                                                    <?php if ($errors->has('invoice_text')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('invoice_text'); ?>
                                                    <span class="invalid-bug_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('invoice_color',__('Invoice Prefix Color'))); ?>

                                                    <input class="jscolor form-control" value="<?php echo e($settings['invoice_color']); ?>" name="invoice_color" id="invoice_color">
                                                    <?php if ($errors->has('invoice_color')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('invoice_color'); ?>
                                                    <span class="invalid-bug_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <?php echo e(Form::submit(__('Save Change'),array('class'=>'btn btn-primary'))); ?>

                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="company-setting" role="tabpanel" aria-labelledby="contact-tab4">
                                    <div class="email-setting-wrap">
                                        <div class="row">
                                            <?php echo e(Form::model($settings,array('route'=>'company.settings','method'=>'post'))); ?>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_name *',__('Company Name *'))); ?>

                                                        <?php echo e(Form::text('company_name',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_name'); ?>
                                                        <span class="invalid-company_name" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_address',__('Address'))); ?>

                                                        <?php echo e(Form::text('company_address',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_address'); ?>
                                                        <span class="invalid-company_address" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_city',__('City'))); ?>

                                                        <?php echo e(Form::text('company_city',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_city'); ?>
                                                        <span class="invalid-company_city" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_state',__('State'))); ?>

                                                        <?php echo e(Form::text('company_state',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_state')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_state'); ?>
                                                        <span class="invalid-company_state" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_zipcode',__('Zip/Post Code'))); ?>

                                                        <?php echo e(Form::text('company_zipcode',null,array('class'=>'form-control'))); ?>

                                                        <?php if ($errors->has('company_zipcode')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_zipcode'); ?>
                                                        <span class="invalid-company_zipcode" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <?php echo e(Form::label('company_country',__('Country'))); ?>

                                                        <?php echo e(Form::text('company_country',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_country'); ?>
                                                        <span class="invalid-company_country" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_telephone',__('Telephone'))); ?>

                                                        <?php echo e(Form::text('company_telephone',null,array('class'=>'form-control'))); ?>

                                                        <?php if ($errors->has('company_telephone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_telephone'); ?>
                                                        <span class="invalid-company_telephone" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_email',__('System Email *'))); ?>

                                                        <?php echo e(Form::text('company_email',null,array('class'=>'form-control'))); ?>

                                                        <?php if ($errors->has('company_email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_email'); ?>
                                                        <span class="invalid-company_email" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <?php echo e(Form::label('company_email_from_name',__('Email (From Name) *'))); ?>

                                                        <?php echo e(Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))); ?>

                                                        <?php if ($errors->has('company_email_from_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company_email_from_name'); ?>
                                                        <span class="invalid-company_email_from_name" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                    </div>
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
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/settings/company.blade.php ENDPATH**/ ?>