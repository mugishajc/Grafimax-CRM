<?php echo e(Form::open(array('url' => 'jobs','method'=>'post'))); ?>

<div class="form-group col-md-12">
        <?php echo e(Form::label('job_name',__('Job name'))); ?>

        <?php echo e(Form::text('job_name',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

    
    </div>
<div class="form-row col-md-12">
    <div class="form-group col-md-6">
        <?php echo e(Form::label('Client',__('Client name'))); ?>

        <?php echo e(Form::text('Client',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

    
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('Tel',__('Telephone'))); ?>

        <?php echo e(Form::text('Tel',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

    </div>
    </div>
    
<div class="form-row col-md-12">
<div class="form-group col-md-6">
        <?php echo e(Form::label('received_by',__('Received By'))); ?> <br>
        <?php echo e(Auth::user()->name); ?>

    </div>
<div class="form-group col-md-6">
        <?php echo e(Form::label('performed_by',__('Performed By'))); ?> 
        <?php echo e(Form::text('performed_by',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

    </div>
</div>
 
<div class="col-md-12 text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/jobs/create.blade.php ENDPATH**/ ?>