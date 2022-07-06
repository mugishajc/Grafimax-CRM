<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        function getTask(obj, project_id) {
            $('#task_id').empty();
            var milestone_id = obj.value;
            $.ajax({
                url: '<?php echo route('invoices.milestone.task'); ?>',
                data: {
                    "milestone_id": milestone_id,
                    "project_id": project_id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].title + '</option>';

                    }
                    $('#task_id').append(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', data.error, 'error')
                }
            });
        }

        function hide_show(obj) {
            if (obj.value == 'milestone') {
                document.getElementById('milestone').style.display = 'block';
                document.getElementById('other').style.display = 'none';
            } else {
                document.getElementById('other').style.display = 'block';
                document.getElementById('milestone').style.display = 'none';
            }
        }

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Invoice Detail')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item active"><a href="<?php echo e(route('invoices.index')); ?>"><?php echo e(__('Invoice')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Invoice Detail')); ?></div>
            </div>
        </div>

        <div class="section-body card">
            <div class="card-header d-flex align-items-center">
                <h4><?php echo e(__('Invoices')); ?></h4>
                <div class="card-header-action">
                    <div class="btn-group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice product')): ?>
                            <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('invoices.products.add',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Item')); ?>">
                                <span><i class="fas fa-plus"></i></span>
                                <?php echo e(__('Add Item')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice payment')): ?>
                            <a href="#" class="btn btn-sm btn-warning mx-2" data-url="<?php echo e(route('invoices.payments.create',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Payment')); ?>">
                                <span><i class="fas fa-plus"></i></span>
                                <?php echo e(__('Add Payment')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                            <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('invoices.edit',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Invoice')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                <span><i class="far fa-edit"></i></span>
                                <?php echo e(__('Edit Invoice')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage invoice')): ?>
                            <a href="<?php echo e(route('get.invoice',$invoice->id)); ?>" class="btn btn-sm btn-warning ml-2" download title="<?php echo e(__('Download Invoice')); ?>">
                                <span><i class="fa fa-file-download"></i></span>
                            </a>
                            <a href="<?php echo e(route('get.invoice',$invoice->id)); ?>" class="btn btn-sm btn-warning ml-2" title="<?php echo e(__('Print Invoice')); ?>" target="_blanks">
                                <span><i class="fa fa-print"></i></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-right mb-10">
                                <h5><?php echo e(Auth::user()->invoiceNumberFormat($invoice->id)); ?></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong><?php echo e(__('Billed To')); ?> : </strong><br>
                                        <?php echo e($settings['company_name']); ?><br>
                                        <?php echo e($settings['company_address']); ?><br>
                                        <?php echo e($settings['company_city']); ?>, <?php echo e($settings['company_state']); ?>-<?php echo e($settings['company_zipcode']); ?><br>
                                        <?php echo e($settings['company_country']); ?>

                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong><?php echo e(__('Shipped To')); ?>:</strong><br>
                                        <?php echo e((!empty($user))?$user->name:''); ?><br>
                                        <?php echo e((!empty($user))?$user->email:''); ?><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <address>
                                        <strong><?php echo e(__('Status')); ?>:</strong><br>
                                        <div class="font-weight-bold font-style">
                                            <?php if($invoice->status == 0): ?>
                                                <span class="badge badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 1): ?>
                                                <span class="badge badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 2): ?>
                                                <span class="badge badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 3): ?>
                                                <span class="badge badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 4): ?>
                                                <span class="badge badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </address>
                                </div>
                                <?php if(!empty($invoice->project)): ?>
                                    <div class="col-md-3 text-md-center">
                                        <strong><?php echo e(__('Project')); ?>:</strong><br>
                                        <?php echo e($invoice->project->name); ?><br><br>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-3 text-md-center">
                                    <strong><?php echo e(__('Issue Date')); ?>:</strong><br>
                                    <?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?><br>
                                </div>
                                <div class="col-md-3 text-md-right">
                                    <strong><?php echo e(__('Due Date')); ?>:</strong><br>
                                    <?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?><br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-12">
                            <div class="section-title"><?php echo e(__('Order Summary')); ?>

                                <div class="col-md-12 text-right">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice product')): ?>
                                        <a href="#" class="btn btn-sm btn-warning" data-url="<?php echo e(route('invoices.products.add',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Item')); ?>">
                                            <span><i class="fas fa-plus"></i></span>
                                            <?php echo e(__('Add')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th class="text-center"><?php echo e(__('Item')); ?></th>
                                        <th class="text-center"><?php echo e(__('Price')); ?></th>
                                        <th class="text-right"><?php echo e(__('Action')); ?></th>

                                    </tr>
                                    <?php $i=0; ?>

                                    <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e(++$i); ?>

                                            </td>
                                            <td class="text-center font-style">
                                                <?php echo e($items->iteam); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e(Auth::user()->priceFormat($items->price)); ?>

                                            </td>
                                            <td class="table-actions text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                                    <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($items->id); ?>').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoices.products.delete', $invoice->id,$items->id],'id'=>'delete-form-'.$items->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <?php
                            $subTotal = $invoice->getSubTotal();
                         $tax = $invoice->getTax();
                        ?>
                        <div class="col-md-2">
                            <div class="invoice-detail-name"><b><?php echo e(__('Subtotal')); ?></b></div>
                            <div class="invoice-detail-value"> <?php echo e(Auth::user()->priceFormat($subTotal)); ?></div>
                        </div>
                        <div class="col-md-2 text-md-center">
                            <div class="invoice-detail-name"><b><?php echo e(__('Discount')); ?></b></div>
                            <div class="invoice-detail-value"> <?php echo e(Auth::user()->priceFormat($invoice->discount)); ?></div>
                        </div>

                        <div class="col-md-3 text-md-center">
                            <div class="invoice-detail-name"><b><?php echo e((!empty($invoice->tax)?$invoice->tax->name:'Tax')); ?> (<?php echo e((!empty($invoice->tax->rate)?$invoice->tax->rate:'0')); ?> %)</b></div>
                            <div class="invoice-detail-value"> <?php echo e(Auth::user()->priceFormat($tax)); ?></div>
                        </div>
                        <div class="col-md-3 text-md-center">
                            <div class="invoice-detail-name"><b><?php echo e(__('Total')); ?></b></div>
                            <div class="invoice-detail-value"><?php echo e(Auth::user()->priceFormat($subTotal-$invoice->discount+$tax)); ?></div>
                        </div>
                        <div class="col-md-2 text-md-right">
                            <div class="invoice-detail-name"><b><?php echo e(__('Due Amount')); ?></b></div>
                            <div class="invoice-detail-value"> <?php echo e(Auth::user()->priceFormat($invoice->getDue())); ?></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="section-title">
                                <?php echo e(__('Payment History')); ?>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th><?php echo e(__('Transaction ID')); ?></th>
                                        <th class="text-center"><?php echo e(__('Payment Date')); ?></th>
                                        <th class="text-center"><?php echo e(__('Payment Method')); ?></th>
                                        <th class="text-center"><?php echo e(__('Note')); ?></th>
                                        <th class="text-right"><?php echo e(__('Amount')); ?></th>
                                    </tr>
                                    <?php $i=0; ?>
                                    <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e(sprintf("%05d", $payment->transaction_id)); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e(Auth::user()->dateFormat($payment->date)); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e((!empty($payment->payment)?$payment->payment->name:'')); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e($payment->notes); ?>

                                            </td>
                                            <td class="text-right">
                                                <?php echo e(Auth::user()->priceFormat($payment->amount)); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/invoices/view.blade.php ENDPATH**/ ?>