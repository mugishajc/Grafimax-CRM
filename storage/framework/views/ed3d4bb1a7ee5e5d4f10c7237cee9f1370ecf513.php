<?php echo e(Form::open(array('url' => 'invoices'))); ?>

<div class="row">
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('project_id', __('Project'))); ?>

        <?php echo e(Form::select('project_id', $projects,null, array('class' => 'form-control font-style selectric'))); ?>

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
        <?php echo e(Form::label('issue_date', __('Issue Date'))); ?>

        <?php echo e(Form::text('issue_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        <?php if ($errors->has('issue_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('issue_date'); ?>
        <span class="invalid-issue_date" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('due_date', __('Due Date'))); ?>

        <?php echo e(Form::text('due_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        <?php if ($errors->has('due_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('due_date'); ?>
        <span class="invalid-due_date" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('tax_id', __('Tax %'))); ?>

        <?php echo e(Form::select('tax_id', $taxes,null, array('class' => 'form-control font-style selectric'))); ?>

        <?php if ($errors->has('tax_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tax_id'); ?>
        <span class="invalid-tax_id" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('terms', __('Terms'))); ?>

        <?php echo Form::textarea('terms', null, ['class'=>'form-control','rows'=>'2']); ?>

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

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/invoices/create.blade.php ENDPATH**/ ?>