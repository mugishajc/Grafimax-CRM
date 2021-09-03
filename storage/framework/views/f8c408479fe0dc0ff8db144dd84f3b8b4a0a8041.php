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
                        labels:<?php echo json_encode($chartData['label']); ?>,
                        datasets: [{
                            label: 'Order',
                            data:<?php echo json_encode($chartData['data']); ?>

                        }]
                    }
                });
                $this.data('chart', salesChart);
            };
            if ($chart.length) {
                init($chart);
            }
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <div class="count"><?php echo e($user['total_user']); ?></div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('TOTAL USERS')); ?></h4>
                        </div>
                    </div>
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="progreess-status mt-2">
                                <span><?php echo e(__('Paid Users')); ?></span>
                                <span><strong><?php echo e($user['total_paid_user']); ?> </strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <div class="count"><?php echo e($user['total_orders']); ?></div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('TOTAL ORDERS')); ?></h4>
                        </div>
                    </div>
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="progreess-status mt-2">
                                <span><?php echo e(__('Total Order Amount')); ?></span>
                                <span><strong><?php echo e($user['total_orders_price']); ?>  </strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <div class="count"><?php echo e($user['total_plan']); ?></div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('TOTAL PLANS')); ?></h4>
                        </div>
                    </div>
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="progreess-status mt-2">
                                <span><?php echo e(__('Total Purchase Plan')); ?></span>
                                <span><strong><?php echo e($user['most_purchese_plan']); ?>  </strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="h3 mb-0"><?php echo e(__('Recent Order')); ?></h5>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="chart-sales" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/dashboard/super_admin.blade.php ENDPATH**/ ?>