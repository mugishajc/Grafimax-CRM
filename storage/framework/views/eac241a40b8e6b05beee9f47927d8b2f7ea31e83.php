<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Invoice')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Invoice')); ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4><?php echo e(__('Manage Invoice')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                                    <a href="#" data-url="<?php echo e(route('invoices.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Invoice')); ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0">
                                <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush" id="dataTable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th> <?php echo e(__('Invoice')); ?></th>
                                                        <th> Job</th>
                                                        <th> <?php echo e(__('Issue Date')); ?></th>
                                                        <th> <?php echo e(__('Due Date')); ?></th>
                                                        <th> <?php echo e(__('Value')); ?></th>
                                                        <th> <?php echo e(__('Status')); ?></th>
                                                        <?php if(Gate::check('edit invoice') || Gate::check('delete invoice')): ?>
                                                            <th> <?php echo e(__('Action')); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>

                                                            <td>
                                                                <a href="<?php echo e(route('invoices.show',$invoice->id)); ?>" class="btn btn-outline-primary btn-sm"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->id)); ?></a>
                                                            </td>
                                                            <td><?php echo e((isset($invoice->project) && !empty($invoice->project)) ? $invoice->project->name : '-'); ?></td>
                                                            <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                                            <td><?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?></td>
                                                            <td><?php echo e(Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                                            <td>
                                                                <?php if($invoice->status == 0): ?>
                                                                    <span class="label label-soft-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                                                <?php elseif($invoice->status == 1): ?>
                                                                    <span class="label label-soft-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                                                <?php elseif($invoice->status == 2): ?>
                                                                    <span class="label label-soft-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                                                <?php elseif($invoice->status == 3): ?>
                                                                    <span class="label label-soft-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                                                <?php elseif($invoice->status == 4): ?>
                                                                    <span class="label label-soft-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if(Gate::check('edit invoice') || Gate::check('delete invoice')): ?>
                                                                <td class="action">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                                                        <a href="<?php echo e(route('invoices.show',$invoice->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                                        <a href="#!" data-url="<?php echo e(route('invoices.edit',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Invoice')); ?>" class="btn btn-outline btn-sm blue-madison" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                                        <a href="#!" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoices.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]); ?>

                                                                        <?php echo Form::close(); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/invoices/index.blade.php ENDPATH**/ ?>