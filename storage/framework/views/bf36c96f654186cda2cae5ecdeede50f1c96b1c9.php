
<?php echo e(Form::model($plan, array('route' => array('plans.update', $plan->id), 'method' => 'PUT', 'enctype' => "multipart/form-data"))); ?>

<div class="row">
    <div class="form-group col-md-6">
        <?php echo e(Form::label('name',__('Name'))); ?>

        <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('price',__('Price'))); ?>

        <?php echo e(Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'required'=>'required'))); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('duration', __('Duration'))); ?>

        <?php echo Form::select('duration', $arrDuration, null,array('class' => 'form-control selectric','required'=>'required')); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('max_users',__('Maximum Users'))); ?>

        <?php echo e(Form::number('max_users',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('max_clients',__('Mabimum Clients'))); ?>

        <?php echo e(Form::number('max_clients',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('max_projects',__('Maximum Projects'))); ?>

        <?php echo e(Form::number('max_projects',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
    </div>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('image', __('Image'))); ?>

        <?php echo e(Form::file('image', array('class' => 'form-control'))); ?>

        <span class="small"><?php echo e(__('Please upload a valid image file. Size of image should not be more than 2MB.')); ?></span>
    </div>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('description', __('Description'))); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

    </div>
    <div class="form-group col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>



<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/plan/edit.blade.php ENDPATH**/ ?>