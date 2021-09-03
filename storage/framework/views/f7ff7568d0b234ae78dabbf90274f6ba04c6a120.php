<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bug Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Bug Report')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></div>
                <div class="breadcrumb-item font-style"><a href="<?php echo e(route('projects.show',$project->id)); ?>"><?php echo e($project->name); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Bug Report')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Bug Report')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
                                <a href="<?php echo e(route('task.bug.kanban',$project->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-bug"></i> <?php echo e(__('Bug Kanban')); ?>

                                </a>
                            <?php endif; ?>

                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bug report')): ?>
                            <a href="#" data-url="<?php echo e(route('task.bug.create',$project->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Bug')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Create Bug')); ?>" class="btn btn-sm btn-warning ml-10">
                                <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="dataTable">
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Bug Id')); ?></th>
                                    <th> <?php echo e(__('Assign To')); ?></th>
                                    <th> <?php echo e(__('Bug Title')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                    <th> <?php echo e(__('Priority')); ?></th>
                                    <th> <?php echo e(__('Description')); ?></th>
                                    <th> <?php echo e(__('Created By')); ?></th>
                                    <th> <?php echo e(__('Date')); ?></th>
                                    <th class="text-right" width="200px"> <?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $bugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(\Auth::user()->bugNumberFormat($bug->bug_id)); ?></td>
                                        <td><?php echo e($bug->assignTo->name); ?></td>
                                        <td><?php echo e($bug->title); ?></td>
                                        <td><?php echo e($bug->bug_status->title); ?></td>
                                        <td><?php echo e($bug->priority); ?></td>
                                        <td><?php echo e($bug->description); ?></td>
                                        <td><?php echo e($bug->createdBy->name); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($bug->created_at)); ?></td>
                                        <td class="action text-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bug report')): ?>
                                                <a href="#" data-url="<?php echo e(route('task.bug.edit',[$project->id,$bug->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Bug Report')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bug report')): ?>
                                                    <a href="#" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($bug->id); ?>').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['task.bug.destroy', $project->id,$bug->id],'id'=>'delete-form-'.$bug->id]); ?>

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
        <div class="section-body">
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/bug.blade.php ENDPATH**/ ?>