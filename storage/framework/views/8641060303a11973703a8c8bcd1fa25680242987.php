<?php echo e(Form::model($user,array('route' => array('users.update', $user->id), 'method' => 'PUT'))); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group ">
            <?php echo e(Form::label('name',__('Name'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter User Name')))); ?>

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
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'))); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

            <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
            <span class="invalid-email" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
    <?php if(\Auth::user()->type != 'super admin'): ?>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('role', __('User Role'))); ?>

            <?php echo Form::select('role', $roles, $user->roles,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

            <?php if ($errors->has('role')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('role'); ?>
            <span class="invalid-role" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    <?php endif; ?>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/user/edit.blade.php ENDPATH**/ ?>