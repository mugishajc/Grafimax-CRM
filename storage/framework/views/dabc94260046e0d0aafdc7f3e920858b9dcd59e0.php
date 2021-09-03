<?php echo e(Form::open(array('url' => 'taxes'))); ?>

<div class="row">
    <div class="form-group col-md-6">
        <?php echo e(Form::label('name', __('Tax Rate Name'))); ?>

        <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

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
    <div class="form-group col-md-6">
        <?php echo e(Form::label('rate', __('Tax Rate %'))); ?>

        <?php echo e(Form::number('rate', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('rate')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('rate'); ?>
        <span class="invalid-rate" role="alert">
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

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/taxes/create.blade.php ENDPATH**/ ?>