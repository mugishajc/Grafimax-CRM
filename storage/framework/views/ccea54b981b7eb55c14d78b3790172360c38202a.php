<?php echo e(Form::open(array('url' => 'labels'))); ?>

<div class="form-group">
    <?php echo e(Form::label('name', __('Label Name'))); ?>

    <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

</div>
<div class="form-group  col-md-12">
    <?php echo e(Form::label('name', __('Color'))); ?>

    <div class="bg-color-label">
        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="custom-control custom-radio  mb-3 <?php echo e($color); ?>">
                <input class="custom-control-input" name="color" id="customCheck_<?php echo e($k); ?>" type="radio" value="<?php echo e($color); ?>">
                <label class="custom-control-label " for="customCheck_<?php echo e($k); ?>"></label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/labels/create.blade.php ENDPATH**/ ?>