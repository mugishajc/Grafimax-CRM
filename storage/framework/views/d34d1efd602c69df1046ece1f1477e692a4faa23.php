<?php echo e(Form::model($invoice, array('route' => array('invoices.products.store', $invoice->id), 'method' => 'POST'))); ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="text" class="form-control font-style" value="<?php echo e($invoice->project->name); ?>" readonly>
        </div>
    </div>
    <div class="col-md-4 mb-10">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="customRadio5" name="type" value="milestone" checked="checked" onclick="hide_show(this)">
            <label class="custom-control-label" for="customRadio5"><?php echo e(__('Milestone & Task')); ?></label>
        </div>
    </div>
    <div class="col-md-4 mb-10">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="customRadio6" name="type" value="other" onclick="hide_show(this)">
            <label class="custom-control-label" for="customRadio6"><?php echo e(__('Other')); ?></label>
        </div>
    </div>
</div>
<div id="milestone">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="milestone_id"><?php echo e(__('Milestone')); ?></label>
                <select class="form-control font-style custom-select" onchange="getTask(this,<?php echo e($invoice->project_id); ?>)" id="milestone_id" name="milestone_id">
                    <option value="" selected="selected"><?php echo e(__('Select Milestone')); ?></option>
                    <?php $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($milestone->id); ?>"><?php echo e($milestone->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="task_id"><?php echo e(__('Task')); ?></label>
                <select class="form-control font-style custom-select" id="task_id" name="task_id">
                    <option value="" selected="selected"><?php echo e(__('Select Task')); ?></option>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($task->id); ?>"><?php echo e($task->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
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

<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/invoices/product.blade.php ENDPATH**/ ?>