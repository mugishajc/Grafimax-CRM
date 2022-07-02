<?php $__env->startPush('css-page'); ?>
    <link href="<?php echo e(asset('assets/default/render/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/default/render/bootstrap-select/js/bootstrap-select.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/pages/scripts/components-bootstrap-select.min.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><?php echo e(__('Products')); ?></span>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-datatable ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-tasks font-green"></i>
                        <span class="caption-subject font-green sbold uppercase"><?php echo e(__('Manage Products')); ?></span>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product')): ?>
                        <span class="create-btn">
                        <a href="#" data-url="<?php echo e(route('products.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Product')); ?>" class="btn btn-circle btn-outline btn-sm blue-madison">
                        <i class="fa fa-plus color"></i>  <?php echo e(__('Create')); ?>

                    </a>
                     </span>
                    <?php endif; ?>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Unit')); ?> </th>
                                <th><?php echo e(__('Description')); ?> </th>
                                <th class="text-right" width="200px"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($product->name); ?></td>
                                    <td><?php echo e($product->price); ?></td>
                                    <td><?php echo e($product->unit()->name); ?></td>
                                    <td><?php echo e($product->description); ?></td>
                                    <td class="action">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <a href="#" data-url="<?php echo e(route('products.edit',$product->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Product')); ?>" class="btn btn-outline btn-sm blue-madison" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project')): ?>
                                            <a href="#" class="btn btn-outline btn-sm red" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($product->id); ?>').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id],'id'=>'delete-form-'.$product->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/products/index.blade.php ENDPATH**/ ?>