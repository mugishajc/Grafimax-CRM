<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead Source')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Lead Source')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Lead Source')); ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Lead Source')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create lead source')): ?>
                                <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('leadsources.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Lead Source')); ?>">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861">
                                        <path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"></path></svg>
                                  </span>
                                    <?php echo e(__('Create')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="constant-table">
                                            <table class="table table-striped">
                                                <thead class="">
                                                <tr>
                                                    <th scope="col" style="width: 60%;"></th>
                                                    <th scope="col" style="width: 20%;"></th>
                                                    <th scope="col" style="width: 10%;"></th>
                                                </tr>
                                                </thead>
                                                <tbody  class="">
                                                <?php $__currentLoopData = $leadsources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadsource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-id="<?php echo e($leadsource->id); ?>">
                                                        <td>
                                                            <a><?php echo e($leadsource->name); ?></a>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted"><?php echo e($leadsource->created_at); ?></span>
                                                        </td>
                                                        <td class="table-actions">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead source')): ?>
                                                                <a href="#" class="table-action" data-url="<?php echo e(route('leadsources.edit',$leadsource->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Lead Source')); ?>" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="far fa-edit"></i></a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead source')): ?>
                                                                <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($leadsource->id); ?>').submit();"><i class="far fa-trash-alt"></i></a>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['leadsources.destroy', $leadsource->id],'id'=>'delete-form-'.$leadsource->id]); ?>

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
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/leadsources/index.blade.php ENDPATH**/ ?>