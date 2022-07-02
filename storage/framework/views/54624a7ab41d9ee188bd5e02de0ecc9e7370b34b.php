<?php echo e(Form::open(array('url' => 'products'))); ?>

<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('name', __('Product Name'))); ?>

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
        <?php echo e(Form::label('price', __('Product Price'))); ?>

        <?php echo e(Form::text('price', '', array('class' => 'form-control','required'=>'required'))); ?>

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
    <div class="form-group col-md-6">
        <?php echo e(Form::label('unit', __('Product Unit'))); ?>

        <?php echo Form::select('unit', $productunits, null,array('class' => 'form-control font-style','required'=>'required')); ?>

        <?php if ($errors->has('unit')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('unit'); ?>
        <span class="invalid-unit" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
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
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn green'))); ?>

</div>

<?php echo e(Form::close()); ?>

<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/products/create.blade.php ENDPATH**/ ?>