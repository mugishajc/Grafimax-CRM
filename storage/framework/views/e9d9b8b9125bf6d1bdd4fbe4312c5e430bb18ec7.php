<?php echo e(Form::open(array('route' => array('project.milestone.store',$project->id)))); ?>

<div class="row">
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('title', __('Title'))); ?>

        <?php echo e(Form::text('title', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?>
        <span class="invalid-title" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('status', __('Status'))); ?>

        <?php echo Form::select('status', $status, null,array('class' => 'form-control selectric','required'=>'required')); ?>

        <?php if ($errors->has('client')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('client'); ?>
        <span class="invalid-client" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('cost', __('Cost'))); ?>

        <?php echo e(Form::number('cost', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('cost')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('cost'); ?>
        <span class="invalid-cost" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('description', __('Description'))); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?>
        <span class="invalid-description" role="alert">
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

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/milestone.blade.php ENDPATH**/ ?>