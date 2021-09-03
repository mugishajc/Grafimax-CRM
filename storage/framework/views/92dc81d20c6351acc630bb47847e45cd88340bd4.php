<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Time Sheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Time Sheet')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></div>
                <div class="breadcrumb-item font-style"><a href="<?php echo e(route('projects.show',$project->id)); ?>"><?php echo e($project->name); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Time Sheet')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Time Sheet')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>
                                <a href="#" data-url="<?php echo e(route('task.timesheet',$project->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Time Sheet')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Create Time Sheet')); ?>" class="btn btn-sm btn-warning">
                                    <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="dataTable">
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Task')); ?></th>
                                    <th> <?php echo e(__('Date')); ?></th>
                                    <th> <?php echo e(__('Hours')); ?></th>
                                    <th> <?php echo e(__('Remark')); ?></th>
                                    <?php if(\Auth::user()->type!='client'): ?>
                                        <th class=" text-right" width="200px"> <?php echo e(__('Action')); ?></th>
                                    <?php else: ?>
                                        <th><?php echo e(__('User')); ?></th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $timeSheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeSheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td class="font-style"><?php echo e(!empty($timeSheet->task())? $timeSheet->task()->title : ''); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($timeSheet->date)); ?></td>
                                        <td><?php echo e($timeSheet->hours); ?></td>
                                        <td class="font-style"><?php echo e($timeSheet->remark); ?></td>
                                        <?php if(\Auth::user()->type!='client'): ?>
                                            <td class="action text-right">
                                                <a href="#" data-url="<?php echo e(route('task.timesheet.edit',[$project->id,$timeSheet->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Time Sheet')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($timeSheet->id); ?>').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['task.timesheet.destroy', $project->id,$timeSheet->id],'id'=>'delete-form-'.$timeSheet->id]); ?>

                                                <?php echo Form::close(); ?>

                                            </td>
                                        <?php else: ?>
                                            <td><?php echo e($timeSheet->user()->name); ?></td>
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
        <div class="section-body">
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/timeSheet.blade.php ENDPATH**/ ?>