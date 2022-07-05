<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Client')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('User')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Client')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Client')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create client')): ?>
                                <a href="#" data-url="<?php echo e(route('clients.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Client')); ?>" class="btn btn-sm btn-warning">
                                    <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="staff-wrap">
                            <div class="row">
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="staff staff-grid-view pb-0">

                                            <div class="more-action">
                                                <?php if($client->is_active==1): ?>
                                                    <div class="dropdown">
                                                        <?php if($client->is_active!=1): ?> <i class="fas fa-lock mr-1"></i><?php endif; ?>
                                                        <a href="" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.13672 0.804688C1.42318 0.518229 1.7526 0.375 2.125 0.375C2.4974 0.375 2.8125 0.518229 3.07031 0.804688C3.35677 1.0625 3.5 1.3776 3.5 1.75C3.5 2.1224 3.35677 2.45182 3.07031 2.73828C2.8125 2.99609 2.4974 3.125 2.125 3.125C1.7526 3.125 1.42318 2.99609 1.13672 2.73828C0.878906 2.45182 0.75 2.1224 0.75 1.75C0.75 1.3776 0.878906 1.0625 1.13672 0.804688ZM8.01172 0.804688C8.29818 0.518229 8.6276 0.375 9 0.375C9.3724 0.375 9.6875 0.518229 9.94531 0.804688C10.2318 1.0625 10.375 1.3776 10.375 1.75C10.375 2.1224 10.2318 2.45182 9.94531 2.73828C9.6875 2.99609 9.3724 3.125 9 3.125C8.6276 3.125 8.29818 2.99609 8.01172 2.73828C7.75391 2.45182 7.625 2.1224 7.625 1.75C7.625 1.3776 7.75391 1.0625 8.01172 0.804688ZM14.8867 0.804688C15.1732 0.518229 15.5026 0.375 15.875 0.375C16.2474 0.375 16.5625 0.518229 16.8203 0.804688C17.1068 1.0625 17.25 1.3776 17.25 1.75C17.25 2.1224 17.1068 2.45182 16.8203 2.73828C16.5625 2.99609 16.2474 3.125 15.875 3.125C15.5026 3.125 15.1732 2.99609 14.8867 2.73828C14.6289 2.45182 14.5 2.1224 14.5 1.75C14.5 1.3776 14.6289 1.0625 14.8867 0.804688Z"
                                                                    fill="#778CA2"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                                <a href="#" class="dropdown-item" data-url="<?php echo e(route('clients.edit',$client->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Update User')); ?>"><?php echo e(__('Edit')); ?></a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                                <a class="dropdown-item" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($client['id']); ?>').submit();">
                                                                    <span><?php if($client->delete_status!=0): ?><?php echo e(__('Delete')); ?> <?php else: ?> <?php echo e(__('Restore')); ?><?php endif; ?></span>
                                                                </a>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $client['id']],'id'=>'delete-form-'.$client['id']]); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <i class="fas fa-lock"></i>
                                                <?php endif; ?>
                                            </div>

                                            <div class="contact-img">
                                                <img src="<?php echo e((!empty($client->avatar))? asset(Storage::url("avatar/".$client->avatar)): asset(Storage::url("avatar/avatar.png"))); ?>" class="rounded-circle">

                                            </div>
                                            <div class="main-info mb-4">
                                                <h2 class="m-0 font-style   "><?php echo e($client->name); ?></h2>
                                                <p class="font-style"> <?php echo e($client->type); ?></p>
                                            </div>
                                            <div class="meta-info mb-3">
                                                <p> <?php echo e($client->email); ?></p>

                                                <p>
                                                </p>
                                            </div>
                                            <div class="btn-wrap">

                                                <button class="btn" title="Project">
                                                    <i class="fas fa-briefcase"></i>
                                                    <span class="pl-2"><?php echo e($client->client_project()); ?> </span>
                                                </button>
                                                <button class="btn" title="Project Budget">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                    <span class="pl-2"><?php echo e(\Auth::user()->priceFormat($client ->client_project_budget())); ?></span>
                                                </button>
                                                <button class="btn" title="Lead">
                                                    <i class="fas fa-tasks"></i>
                                                    <span class="pl-2"><?php echo e($client->client_lead()); ?></span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/client/index.blade.php ENDPATH**/ ?>