<?php echo e(Form::open(array('url'=>'clients','method'=>'post'))); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Client Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'))); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Client Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('password',__('Password'))); ?>

            <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Client Password'),'minlength'=>"6",'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/client/create.blade.php ENDPATH**/ ?>