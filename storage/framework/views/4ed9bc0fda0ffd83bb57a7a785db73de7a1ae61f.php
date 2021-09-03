<?php echo e(Form::open(array('route' => array('invite',$project_id)))); ?>

<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('user', __('User'))); ?>

        <?php echo Form::select('user[]', $employee, null,array('class' => 'form-control selectric','required'=>'required')); ?>

        <?php if ($errors->has('client')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('client'); ?>
        <span class="invalid-user" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Add'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/invite.blade.php ENDPATH**/ ?>