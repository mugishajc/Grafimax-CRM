<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label><?php echo e(__('Title')); ?> :</label>
            <p class="m-0 p-0"><?php echo e($task->title); ?></p>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label><?php echo e(__('Priority')); ?> :</label>
            <p class="m-0 p-0"><?php echo e($task->priority); ?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label><?php echo e(__('Description')); ?> :</label>
            <p class="m-0 p-0"><?php echo e($task->description); ?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label><?php echo e(__('Start Date')); ?> :</label>
            <p class="m-0 p-0"><?php echo e($task->start_date); ?></p>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label><?php echo e(__('Due Date')); ?> :</label>
            <p class="m-0 p-0"><?php echo e($task->due_date); ?></p>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label><?php echo e(__('Milestone')); ?> :</label>
            <p class="m-0 p-0"><?php echo e(!empty($task->milestone)?$task->milestone->title:''); ?></p>
        </div>
    </div>
</div>
<div class="task-inner-tab">
    <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> <?php echo e(__('Checklist')); ?> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> <?php echo e(__('Comments')); ?> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> <?php echo e(__('Files')); ?> </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="progress-wrap">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create checklist')): ?>
                    <?php if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('show checklist',$perArr))): ?>
                        <div class="tab-pane fad active" id="tab_1_3">
                            <div class="row">
                                <?php if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('create checklist',$perArr))): ?>
                                    <div class="col-md-11">
                                        <div class="row mb-10">
                                            <div class="col-md-6">
                                                <b><?php echo e(__('Progress')); ?></b>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <b>
                                                <span class="progressbar-label custom-label" style="margin-top: -9px !important;margin-left: .7rem">
                                                    0%
                                                </span>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <div class="custom-widget__item flex-fill">
                                                <div class="custom-widget__progress d-flex  align-items-center">
                                                    <div class="progress" style="height: 5px;width: 100%;">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="taskProgress"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="text-right mb-1">
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#form-checklist"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" id="form-checklist" class="collapse col-md-12" data-action="<?php echo e(route('task.checklist.store',[$task->id])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Name')); ?></label>
                                        <input type="text" name="name" class="form-control" required placeholder="<?php echo e(__('Checklist Name')); ?>">
                                    </div>
                                    <div class="text-right">
                                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                                            <button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <ul class="col-md-12" id="check-list">
                                    <?php $__currentLoopData = $task->taskCheckList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $checkList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="media">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-1 font-weight-bold"></h5>
                                                <div class=" custom-control custom-checkbox checklist-checkbox">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create checklist')): ?>
                                                        <?php if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('edit checklist',$perArr))): ?>
                                                            <input type="checkbox" id="checklist-<?php echo e($checkList->id); ?>" class="custom-control-input taskCheck" <?php echo e(($checkList->status==1)?'checked':''); ?> value="<?php echo e($checkList->id); ?>" data-url="<?php echo e(route('task.checklist.update',[$checkList->task_id,$checkList->id])); ?>">
                                                            <label for="checklist-<?php echo e($checkList->id); ?>" class="custom-control-label"></label>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php echo e($checkList->name); ?>

                                                </div>
                                                <div class="comment-trash" style="float: right">
                                                    <?php if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('delete checklist',$perArr))): ?>
                                                        <a href="#" class="btn btn-outline btn-sm red text-muted delete-checklist" data-url="<?php echo e(route('task.checklist.destroy',[$checkList->task_id,$checkList->id])); ?>">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="form-group m-0">
                <form method="post" id="form-comment" data-action="<?php echo e(route('comment.store',[$task->project_id,$task->id])); ?>">
                    <textarea class="form-control" name="comment" placeholder="<?php echo e(__('Write message')); ?>" id="example-textarea" rows="3" required></textarea>
                    <div class="text-right mt-10">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="button" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                        </div>
                    </div>
                </form>
                <div class="comment-holder" id="comments">
                    <?php $__currentLoopData = $task->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="media">
                            <div class="media-body">
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <h5 class="mt-0"><?php echo e($comment->user->name); ?></h5>
                                        <p class="mb-0"><?php echo e($comment->comment); ?></p>
                                    </div>
                                    <a href="#" class="btn btn-outline btn-sm red text-muted  delete-comment" data-url="<?php echo e(route('comment.destroy',[$comment->id])); ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="form-group m-0">
                <form method="post" id="form-file" enctype="multipart/form-data" data-url="<?php echo e(route('comment.file.store',$task->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="file" class="form-control mb-2" name="file" id="file">
                    <span class="invalid-feedback" id="file-error" role="alert">
                        <strong></strong>
                    </span>
                    <div class="text-right mt-10">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Upload')); ?></button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <ul class="col-md-12" id="comments-file">
                        <?php $__currentLoopData = $task->taskFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="media">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1 font-weight-bold"> <?php echo e($file->name); ?></h6>
                                    <?php echo e($file->file_size); ?>

                                    <div class="comment-trash" style="float: right">
                                        <a download href="<?php echo e(asset('/storage/tasks/'.$file->file)); ?>" class="btn btn-outline btn-sm blue-madison">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline btn-sm red text-muted delete-comment-file" data-url="<?php echo e(route('comment.file.destroy',[$file->id])); ?>">
                                            <i class="far fa-trash-alt"></i>
                                        </a>

                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/projects/taskShow.blade.php ENDPATH**/ ?>