<?php echo e(Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT'))); ?>

<div class="row">
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('name', __('Projects Name'))); ?>

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
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('price', __('Projects Price'))); ?>

        <?php echo e(Form::number('price', null, array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('price')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('price'); ?>
        <span class="invalid-price" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('date', __('Due Date'))); ?>

        <?php echo e(Form::text('date', $project->due_date, array('class' => 'form-control datepicker','required'=>'required'))); ?>

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
        <?php echo e(Form::label('client', __('Client'))); ?>

        <?php echo Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

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

    <div class="form-group col-md-12">
        <?php echo e(Form::label('lead', __('Lead'))); ?>

        <?php echo Form::select('lead', $leads, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

        <?php if ($errors->has('lead')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('lead'); ?>
        <span class="invalid-lead" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('label', __('Label'),array('class'=>'form-control-label'))); ?>

        <div class="bg-color-label">
            <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="custom-control custom-radio <?php echo e($label->color); ?> mb-3">
                    <input class="custom-control-input" name="label" id="customCheck_<?php echo e($k); ?>" type="radio" value="<?php echo e($label->id); ?>" <?php echo e(($label->id==$project->label)?'checked':''); ?>>
                    <label class="custom-control-label" for="customCheck_<?php echo e($k); ?>"></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

</div>

<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('description', __('Description'))); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control font-style','rows'=>'2']); ?>

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
        <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/edit.blade.php ENDPATH**/ ?>