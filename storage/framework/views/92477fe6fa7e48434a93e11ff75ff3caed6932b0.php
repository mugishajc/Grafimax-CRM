<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

    <script>
        var SalesChart = (function () {
            var $chart = $('#chart-sales');

            function init($this) {
                var salesChart = new Chart($this, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[200],
                                    zeroLineColor: Charts.colors.gray[200]
                                },
                                ticks: {}
                            }]
                        }
                    },
                    data: {
                        labels:<?php echo json_encode($taskData['label']); ?>,
                        datasets: <?php echo json_encode($taskData['dataset']); ?>

                    }
                });
                $this.data('chart', salesChart);
            };
            if ($chart.length) {
                init($chart);
            }
        })();


        var DoughnutChart = (function () {

            var $chart = $('#chart-doughnut');

            function init($this) {
                var randomScalingFactor = function () {
                    return Math.round(Math.random() * 100);
                };
                var doughnutChart = new Chart($this, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($project_status); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_values($projectData)); ?>,
                            backgroundColor: ["#40c5d2", "#f36a5b", "#67b7dc"],
                            // label: 'Dataset 1'
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });

                $this.data('chart', doughnutChart);

            };
            if ($chart.length) {
                init($chart);
            }
        })();

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $lead_percentage = $lead['lead_percentage'];
        $project_percentage = $project['project_percentage'];
        $client_project_budget_due_per = @$project['client_project_budget_due_per'];
        $invoice_percentage = @$invoice['invoice_percentage'];

        $label='';
        if(($lead_percentage<=15)){
            $label='bg-danger';
        }else if ($lead_percentage > 15 && $lead_percentage <= 33) {
            $label='bg-warning';
        } else if ($lead_percentage > 33 && $lead_percentage <= 70) {
            $label='bg-primary';
        } else {
            $label='bg-success';
        }

         $label1='';
        if($project_percentage<=15){
            $label1='bg-danger';
        }else if ($project_percentage > 15 && $project_percentage <= 33) {
            $label1='bg-warning';
        } else if ($project_percentage > 33 && $project_percentage <= 70) {
            $label1='bg-primary';
        } else {
            $label1='bg-success';
        }

        $label2='';
        if($invoice_percentage<=15){
            $label2='bg-danger';
        }else if ($invoice_percentage > 15 && $invoice_percentage <= 33) {
            $label2='bg-warning';
        } else if ($invoice_percentage > 33 && $invoice_percentage <= 70) {
            $label2='bg-primary';
        } else {
            $label2='bg-success';
        }

         $label3='';
        if($client_project_budget_due_per<=15){
            $label3='bg-danger';
        }else if ($client_project_budget_due_per > 15 && $client_project_budget_due_per <= 33) {
            $label3='bg-warning';
        } else if ($client_project_budget_due_per > 33 && $client_project_budget_due_per <= 70) {
            $label3='bg-primary';
        } else {
            $label3='bg-success';
        }

    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <div class="count">Null</div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Debtors</h4>
                        </div>
                    </div>
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="progress">
                                <div class="progress-bar <?php echo e($label); ?>" style="width:<?php echo e($lead_percentage); ?>%"><?php echo e($lead_percentage); ?>%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <div class="count"><?php echo e($project['total_project']); ?></div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Stock Alert</h4>
                        </div>
                    </div>
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="progress">
                                <div class="progress-bar <?php echo e($label1); ?>" style="width:<?php echo e($project_percentage); ?>%"><?php echo e($project_percentage); ?>%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(Auth::user()->type =='company' || Auth::user()->type =='client'): ?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">

                        <div class="card-icon shadow-primary bg-primary">
                            <div class="count"><?php echo e($invoice['total_invoice']); ?></div>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Invoice')); ?></h4>
                            </div>
                        </div>
                        <div class="card-stats">
                            <div class="card-stats-title">
                                <div class="progress">
                                    <div class="progress-bar <?php echo e($label2); ?>" style="width:<?php echo e($invoice_percentage); ?>%"><?php echo e($invoice_percentage); ?>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(Auth::user()->type =='company'): ?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">

                        <div class="card-icon shadow-primary bg-primary">
                            <div class="count"><?php echo e($users['staff']); ?></div>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('TOTAL STAFF')); ?></h4>
                            </div>
                        </div>
                        <!-- <div class="card-stats">
                         <div class="card-stats-title">
                           <div class="progress">
                             <div class="progress-bar" style="width:50%">50%</div>
                           </div>
                         </div>
                       </div> -->
                    </div>
                </div>

            <?php endif; ?>
            <?php if(Auth::user()->type =='client'): ?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">

                        <div class="card-icon shadow-primary bg-primary">
                            <div class="count"><?php echo e(Auth::user()->priceFormat($project['project_budget'])); ?></div>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Project Budget')); ?></h4>
                            </div>
                        </div>
                        <div class="card-stats">
                            <div class="card-stats-title">
                                <div class="progress">
                                    <div class="progress-bar <?php echo e($label3); ?>" style="width:<?php echo e($client_project_budget_due_per); ?>%"><?php echo e($client_project_budget_due_per); ?>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Tasks Overview')); ?></h4>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-sales" height="158"></canvas>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="row">
            <?php if(\Auth::user()->type != 'super admin'): ?>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Job Status</h5>
                        </div>
                        <div class="card-body min-height">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="chart-doughnut" class="chart-canvas chartjs-render-monitor" width="734" height="350" style="display: block; width: 734px; height: 350px;"></canvas>
                            </div>
                            <div class="project-details" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="tx-gray-500 small"><?php echo e(__('On Going')); ?></div>
                                        <div class="font-weight-bold"><?php echo e(number_format($projectData['on_going'],2)); ?> %</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="tx-gray-500 small"><?php echo e(__('On Hold')); ?></div>
                                        <div class="font-weight-bold"><?php echo e(number_format($projectData['on_hold'],2)); ?> %</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="tx-gray-500 small"><?php echo e(__('Completed')); ?></div>
                                        <div class="font-weight-bold"><?php echo e(number_format($projectData['completed'],2)); ?> %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(Auth::user()->type =='company' || Auth::user()->type =='client'): ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Due Payment</h4>

                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                    <tr>
                                        <th><?php echo e(__('Invoice ID')); ?></th>
                                        <th><?php echo e(__('Due Amount')); ?></th>
                                        <th><?php echo e(__('Due Date')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>

                                    <?php $__currentLoopData = $top_due_invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="#"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->id)); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e(Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                            <td><?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('invoices.show',$invoice->id)); ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>

                                            </td>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Due Jobs</h4>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th><?php echo e(__('Task Name')); ?></th>
                                    <th><?php echo e(__('Remain Task')); ?></th>
                                    <th><?php echo e(__('Due Date')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                <?php $__currentLoopData = $project['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $datetime1 = new DateTime($project->due_date);
                                        $datetime2 = new DateTime(date('Y-m-d'));
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');

                                         $project_last_stage = ($project->project_last_stage($project->id))?$project->project_last_stage($project->id)->id:'';
                                        $total_task = $project->project_total_task($project->id);
                                        $completed_task=$project->project_complete_task($project->id,$project_last_stage);
                                        $remain_task=$total_task-$completed_task;
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="#" class="font-style"><?php echo e($project->name); ?></a>
                                        </td>
                                        <td><?php echo e($remain_task); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($project->due_date)); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('projects.show',$project->id)); ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Due Tasks</h4>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th><?php echo e(__('Task Name')); ?></th>
                                    <th><?php echo e(__('Assign To')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                </tr>
                                <?php $__currentLoopData = $top_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a class="font-style" href="#"><?php echo e($top_task->title); ?></a>
                                        </td>
                                        <td>
                                            <?php if(\Auth::user()->type != 'client' && \Auth::user()->type != 'company'): ?>
                                                <p class="font-style"> <?php echo e($top_task->project_name); ?></p>
                                            <?php else: ?>
                                                <p class="font-style"><?php echo e($top_task->task_user->name); ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($top_task->stage_name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/dashboard/index.blade.php ENDPATH**/ ?>