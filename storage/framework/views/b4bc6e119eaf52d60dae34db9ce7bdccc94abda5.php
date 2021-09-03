<?php echo e(Form::open(array('url' => 'leads'))); ?>

<div class="row">
    <div class="form-group col-md-6 ">
        <?php echo e(Form::label('name', __('Name'))); ?>

        <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

    </div>

    <div class="form-group  col-md-6">
        <?php echo e(Form::label('price', __('Price'))); ?>

        <?php echo e(Form::number('price', '', array('class' => 'form-control','required'=>'required'))); ?>

    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('stage', __('Stage'))); ?>

        <?php echo e(Form::select('stage', $stages,null, array('class' => 'form-control font-style selectric','required'=>'required'))); ?>

    </div>
    <?php if(\Auth::user()->type=='company'): ?>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('owner', __('Lead User'))); ?>

            <?php echo Form::select('owner', $owners, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

        </div>
    <?php endif; ?>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('client', __('Client'))); ?>

        <?php echo Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('source', __('Source'))); ?>

        <?php echo Form::select('source', $sources, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

    </div>
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('notes', __('Notes'))); ?>

        <?php echo Form::textarea('notes', '',array('class' => 'form-control','rows'=>'3')); ?>

    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/leads/create.blade.php ENDPATH**/ ?>