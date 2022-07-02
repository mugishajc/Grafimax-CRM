<?php echo e(Form::open(array('url' => 'productunits'))); ?>

<div class="form-group">
    <?php echo e(Form::label('name', __('Product Unit Name'))); ?>

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
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/productunits/create.blade.php ENDPATH**/ ?>