<?php echo e(Form::model($role,array('route' => array('roles.update', $role->id), 'method' => 'PUT'))); ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))); ?>

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
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php if(!empty($permissions)): ?>
                <h6><?php echo e(__('Assign Permission to Roles')); ?> </h6>
                <table class="table table-striped mb-0" id="dataTable-1">
                    <thead>
                    <tr>
                        <th><?php echo e(__('Module')); ?> </th>
                        <th><?php echo e(__('Permissions')); ?> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $modules=['account','user','client','role','company settings','project','product','lead','lead stage','project stage','lead source','label','product unit','expense category','expense','tax','invoice','payment','invoice product','invoice payment','task','checklist','plan','note','bug report','timesheet'];
                        if(Auth::user()->type == 'super admin'){
                            $modules[] = 'language';
                            $modules[] = 'permission';
                             $modules[] = 'system settings';
                        }
                    ?>
                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(ucfirst($module)); ?></td>
                            <td>
                                <div class="row">
                                    <?php if(in_array('manage '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('manage '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('create '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('create '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('edit '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('edit '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('delete '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('delete '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('show '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('show '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('move '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('move '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('client permission '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('client permission '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Client Permission',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('invite user '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('invite user '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Invite User ',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('change password '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('change password '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Change Password ',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('buy '.$module,(array) $permissions)): ?>
                                        <?php if($key = array_search('buy '.$module,$permissions)): ?>
                                            <div class="col-md-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                <?php echo e(Form::label('permission'.$key,'Buy',['class'=>'custom-control-label'])); ?><br>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/role/edit.blade.php ENDPATH**/ ?>