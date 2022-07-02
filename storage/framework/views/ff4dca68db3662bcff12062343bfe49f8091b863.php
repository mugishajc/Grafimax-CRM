<head>
    <script>
    function myFunction()
    {
     quantity = parseInt(document.getElementById("quantity").value);
     cost_value = parseInt(document.getElementById("cost_value").value);
        if(!value1==""&&!cost_value=="")
        {
         sum = quantity * cost_value;
         document.getElementById("total").value = sum;
         console. log(sum);
         alert(sum)
        }
    }
    </script>
    </head>

<?php $__env->startSection('page-title'); ?>
    Add new Inventory
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Inventory Unit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item">Inventory</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="container">


                            <form class="needs-validation" novalidate>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="quantity">Product Name</label>
                                    <?php echo Form::select('product_name', $productnames, null,array('class' => 'custom-select my-1 mr-sm-2','required'=>'required')); ?>

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

                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="quantity">Quantity</label>
                                    <input type="number" class="custom-select my-1 mr-sm-2" id="validationServerUsername" onkeyup="myFunction() aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                      Quantity is needed!
                                    </div>
                                  </div>

                                </div>

                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="costvalue">Cost Value</label>
                                    <input type="number" class="custom-select my-1 mr-sm-2" id="cost_value" onkeyup="myFunction() aria-describedby="inputGroupPrepend3 cost-value" required>
                                    <div id="cost_value" class="invalid-feedback">
                                      Cost value is needed!
                                    </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="product_unit">Select Product Unit</label>
                                    <?php echo Form::select('product_unit', $productunits, null,array('class' => 'custom-select my-1 mr-sm-2','required'=>'required')); ?>

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




                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="my-1 mr-2" for="validationDoneby">Done by</label>
                                        <input type="text" class="custom-select my-1 mr-sm-2" id="validationServer01"  value="<?php echo e(Auth::user()->name); ?>" readonly>

                                      </div>
                                    <div class="form-group col-md-6">

                                      <label class="my-1 mr-2" for="total">Total Amount</label>
                                       <span class=" custom-select my-1 mr-sm-2 badge badge-secondary">New</span>


                                    </div>

                                  </div>

                                <div class="form-row justify-content-center">
                                <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>

                                </div>
                              </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/Inventory/index.blade.php ENDPATH**/ ?>