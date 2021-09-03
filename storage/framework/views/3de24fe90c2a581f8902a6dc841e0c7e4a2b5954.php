<?php echo e(Form::open(array('url' => 'expenses','enctype' => "multipart/form-data"))); ?>

<div class="row">
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('category_id', __('Category'))); ?>

        <?php echo e(Form::select('category_id', $category,null, array('class' => 'form-control font-style selectric','required'=>'required'))); ?>

        <?php if ($errors->has('category_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('category_id'); ?>
        <span class="invalid-category_id" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('amount', __('Amount'))); ?>

        <?php echo e(Form::number('amount', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('amount')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('amount'); ?>
        <span class="invalid-amount" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('date', __('Date'))); ?>

        <?php echo e(Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        <?php if ($errors->has('date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('date'); ?>
        <span class="invalid-date" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('project_id', __('Project'))); ?>

        <?php echo e(Form::select('project_id', $projects,null, array('class' => 'form-control font-style selectric','required'=>'required'))); ?>

        <?php if ($errors->has('project_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('project_id'); ?>
        <span class="invalid-project_id" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('user_id', __('User'))); ?>

        <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control font-style selectric','required'=>'required'))); ?>

        <?php if ($errors->has('user_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('user_id'); ?>
        <span class="invalid-user_id" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('attachment', __('Attachment'))); ?>

        <?php echo e(Form::file('attachment', array('class' => 'form-control','accept'=>'.jpeg,.jpg,.png,.doc,.pdf'))); ?>

        <?php if ($errors->has('attachment')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('attachment'); ?>
        <span class="invalid-attachment" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('description', __('Description'))); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        <?php if ($errors->has('terms')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('terms'); ?>
        <span class="invalid-terms" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/expenses/create.blade.php ENDPATH**/ ?>