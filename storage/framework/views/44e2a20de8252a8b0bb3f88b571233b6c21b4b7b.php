
<?php echo e(Form::model($expense, array('route' => array('expensescategory.update', $expense->id), 'method' => 'PUT'))); ?>

<div class="form-group">
    <?php echo e(Form::label('name', __('Expenses Category Name'))); ?>

    <?php echo e(Form::text('name', null, array('class' => 'form-control font-style','required'=>'required'))); ?>

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
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/expensescategory/edit.blade.php ENDPATH**/ ?>