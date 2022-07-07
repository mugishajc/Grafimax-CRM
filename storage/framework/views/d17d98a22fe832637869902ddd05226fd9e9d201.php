<?php echo e(Form::model($invoice, array('route' => array('invoices.products.store', $invoice->id), 'method' => 'POST'))); ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            

            <input type="text" class="form-control font-style" value="<?php echo e($invoice_user); ?>" readonly>
        </div>
    </div>
    
    
</div>

<div id="other" style="display: none">
    <div id="milestone">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title"><?php echo e(__('Title')); ?></label>
                    <input type="text" class="form-control font-style" name="title">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title"><?php echo e(__('Select Product item')); ?></label>

            <select name="title" class="form-control font-style">
        <?php $__currentLoopData = $item_invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

     <option value="<?php echo e($item_invoice->name); ?>" ><?php echo e($item_invoice->name); ?> --- Price per 1 = <?php echo e($item_invoice->price); ?></option>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
            

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="price"><?php echo e(__('Price')); ?></label>
            <input type="number" class="form-control font-style" name="price" required>
        </div>
    </div>
    <?php if(isset($invoice)): ?>
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary'))); ?>

        </div>
    <?php else: ?>
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
            <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

        </div>
    <?php endif; ?>
    <?php echo e(Form::close()); ?>

</div>

<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/invoices/product.blade.php ENDPATH**/ ?>