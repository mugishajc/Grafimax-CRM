<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
  Job Card
<?php $__env->stopSection(); ?>
<!-- <?php $__env->startPush('script-page'); ?>
    <script>
        function getTask(obj, project_id) {
            $('#job_id').empty();
            var milestone_id = obj.value;
            $.ajax({
                url: '<?php echo route('invoices.milestone.task'); ?>',
                data: {
                    "milestone_id": milestone_id,
                    "project_id": project_id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].title + '</option>';

                    }
                    $('#job_id').append(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', data.error, 'error')
                }
            });
        }

        function hide_show(obj) {
            if (obj.value == 'milestone') {
                document.getElementById('milestone').style.display = 'block';
                document.getElementById('other').style.display = 'none';
            } else {
                document.getElementById('other').style.display = 'block';
                document.getElementById('milestone').style.display = 'none';
            }
        }

    </script>
<?php $__env->stopPush(); ?> -->

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Job</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item">Jobcard</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <div class="d-flex justify-content-between w-100">
                            <h4>Create new job</h4>

                           
                                <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('notes.create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create Note')); ?>">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                                  </span>
                                    Add item
                                </a>
                        
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="staff-wrap">
                            <div class="row">
                                
                            <?php echo e(Form::open(array('url' => 'projects'))); ?>

<div class="row">

<div class="form-group col-md-2">
        <?php echo e(Form::label('client', __('Client'))); ?>

        <?php echo Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')); ?>

        <?php if ($errors->has('client')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('client'); ?>
        <span class="invalid-client" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group col-md-2">
        <?php echo e(Form::label('user', __('Performed By'))); ?>

        <?php echo Form::select('user[]', $users, null,array('class' => 'form-control font-style selectric','data-toggle'=>'select','required'=>'required')); ?>

        <?php if ($errors->has('user')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('user'); ?>
        <span class="invalid-user" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    
    <div class="form-group col-md-2">
        <?php echo e(Form::label('date', __('Start Date'))); ?>

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
    <div class="form-group col-md-2">
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
    

    <div class="form-group col-md-2">
        <?php echo e(Form::label('name', __('Job Name'))); ?>

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
    <div class="form-group col-md-2">
        <?php echo e(Form::label('price', __('Price'))); ?>

        <?php echo e(Form::number('price', '', array('class' => 'form-control','required'=>'required'))); ?>

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
    
    
<div class="row">
    <div class="form-group  col-md-12">
        

    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr >
                                    <th style="width:15em;">Item</th>
                                    <th style="width:8em;">Size</th>
                                    <th>Quantity</th>
                                    <th style="width:10em;">Price</th>
                                    <th style="width:10em;">subtotal <th>
                                        
                                </tr>
<!-- table row 
                                style="outline: thin solid" -->

                               

                                
                            </table>

                            <a href="#"  data-toggle="modal" data-target="#myModal" id="open" class="btn btn-sm btn-warning">
                                            <span><i class="fas fa-plus"></i></span>
                                            <?php echo e(__('Add')); ?>

                                        </a>

                                        <!-- <form method="post" action="#" id="form">
        <?php echo csrf_field(); ?>
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	.
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

<div class="form-group col-md-6">
        <?php echo e(Form::label('item_name', __('Item Name'))); ?>

        <?php echo e(Form::text('item_name', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('item_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('item_name'); ?>
        <span class="invalid-client" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    
    <div class="form-group col-md-6">
        <?php echo e(Form::label('size', __('Size'))); ?>

        <?php echo e(Form::text('size', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('size')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('size'); ?>
        <span class="invalid-name" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('quantity', __('quantity'))); ?>

        <?php echo e(Form::number('quantity', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('q')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('q'); ?>
        <span class="invalid-price" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group col-md-6">
    <?php echo e(Form::label('priceperunit', __('Per per Unit'))); ?>

        <?php echo e(Form::number('priceperunit', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('priceperunit')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('priceperunit'); ?>
        <span class="invalid-price" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('subtotal', __('Subtotal'))); ?>

        <?php echo e(Form::text('subtotal', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php if ($errors->has('subtotal')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('subtotal'); ?>
        <span class="invalid-client" role="alert">
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
</div> -->

      <!-- <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
        </div>
    </div> -->
  </div>
</div>
  </form>


                        </div>
                    </div>
                </div>
            </div>



    </div>
    
    <div class="form-group col-md-6">
        <?php echo e(Form::label('received_by', __('Received By'))); ?>

        <?php echo e(Auth::user()->name); ?>

    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>

<?php echo e(Form::close()); ?>





                            
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    


    
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/create.blade.php ENDPATH**/ ?>