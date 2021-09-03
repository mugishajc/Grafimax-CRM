
<?php echo e(Form::open(array('route' => array('task.store',$project->id)))); ?>

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
        <?php echo e(Form::label('priority', __('Priority'))); ?>

        <?php echo Form::select('priority', $priority, null,array('class' => 'form-control selectric','required'=>'required')); ?>

        <?php if ($errors->has('priority')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('priority'); ?>
        <span class="invalid-priority" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('start_date', __('Start Date'))); ?>

        <?php echo e(Form::text('start_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        <?php if ($errors->has('start_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('start_date'); ?>
        <span class="invalid-start_date" role="alert">
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
    <?php if(\Auth::user()->type == 'company'): ?>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('assign_to', __('Assign To'))); ?>

        <?php echo Form::select('assign_to', $users, null,array('class' => 'form-control selectric','required'=>'required')); ?>

        <?php if ($errors->has('assign_to')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('assign_to'); ?>
        <span class="invalid-assign_to" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <?php endif; ?>
    <!--     
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('milestone_id', __('Milestone'))); ?>

            <?php echo Form::select('milestone_id', $milestones, null,array('class' => 'form-control selectric')); ?>

            <?php if ($errors->has('milestone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('milestone'); ?>
            <span class="invalid-milestone" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div> -->
</div>
<div class="row">
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('description', __('Description'))); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control ','rows'=>'2']); ?>

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

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/taskCreate.blade.php ENDPATH**/ ?>