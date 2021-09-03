<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php
    $dir= asset(Storage::url('plan'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Plan')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Plan')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Plan')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create plan')): ?>
                                <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('plans.create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Plan')); ?>">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                                  </span>
                                    <?php echo e(__('Create')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="staff-wrap">
                            <div class="row">
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12 col-md-3 col-lg-3">
                                        <div class="pricing">
                                            <div class="pricing-title">
                                                <?php echo e($plan->name); ?>

                                            </div>
                                            <div class="flex mt-3">
                                                <?php if(!empty($plan->image)): ?>
                                                    <img class="plan-img" src="<?php echo e($dir.'/'.$plan->image); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="pricing-padding">
                                                <div class="pricing-price">
                                                    <div> $<?php echo e($plan->price); ?></div>
                                                    <div><?php echo e($plan->duration); ?></div>
                                                </div>
                                                <div class="pricing-details">
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label"><?php echo e($plan->max_users); ?> <?php echo e(__('Users')); ?></div>
                                                    </div>
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label"><?php echo e($plan->max_clients); ?> <?php echo e(__('Clients')); ?></div>
                                                    </div>
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label"><?php echo e($plan->max_projects); ?> <?php echo e(__('Projects')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing-cta">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit plan')): ?>
                                                    <a href="#" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="far fa-edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('buy plan')): ?>
                                                    <?php if($plan->id!=\Auth::user()->plan): ?>
                                                        <a href="<?php echo e(route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"><i class="fa fa-cart-plus"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id): ?>
                                                    <div class="text-center">
                                                        <a class="view-btn">
                                                            <?php echo e(__('Active')); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/plan/index.blade.php ENDPATH**/ ?>