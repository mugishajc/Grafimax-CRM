<?php
    $users=\Auth::user();
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('dashboard')); ?>">
                <!-- <img class="img-fluid" src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt="image" width="">
             -->
             Grafimax CRM
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <!-- <a href="<?php echo e(route('dashboard')); ?>">
                <img class="img-fluid" src="<?php echo e(asset(Storage::url('logo/small-logo.png'))); ?>" alt="image" width="">
            </a> -->
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown <?php echo e((Request::route()->getName() == 'dashboard') ? ' active' : ''); ?> ">
                <a class="nav-link" href="<?php echo e(route('dashboard')); ?>"> <i class="fas fa-fire"></i> <span><?php echo e(__('Dashboard')); ?></span></a>
            </li>

            <?php if(\Auth::user()->type=='super admin'): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                    <li class="dropdown <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('users.index')); ?>"> <i class="fas fa-columns"></i> <span><?php echo e(__('User')); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php else: ?>

                <?php if(Gate::check('manage client') || Gate::check('manage user') || Gate::check('manage role')): ?>
                    <li class="dropdown <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?' active':''); ?>">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span><?php echo e(__('Staff')); ?></span></a>
                        <ul class="dropdown-menu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?'display:block':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                <li class="<?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage client')): ?>
                                <li class="<?php echo e((Request::route()->getName() == 'clients.index' || Request::route()->getName() == 'clients.create' || Request::route()->getName() == 'clients.edit') ? ' active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(route('clients.index')); ?>"><?php echo e(__('Client')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                <li class="<?php echo e((Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
<!-- 
            <?php if(Gate::check('manage lead') || \Auth::user()->type=='client'): ?>
                <li class="<?php echo e((Request::segment(1) == 'leads')?'active':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('leads.index')); ?>"><i class="fab fa-dribbble"></i> <span><?php echo e(__('Leads')); ?></span></a>
                </li>

            <?php endif; ?> -->

            <?php if(Gate::check('manage project')): ?>
                <li class="<?php echo e((Request::segment(1) == 'projects')?'active open':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('projects.index')); ?>"><i class="fas fa-tasks"></i> <span>Job</span></a>
                </li>
            <?php endif; ?>
<!--             
                <li class="<?php echo e((Request::segment(1) == 'jobs')?'active open':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('jobs.index')); ?>"><i class="fab fa-dribbble"></i> <span>Job</span></a>
                </li> -->
            
            <?php if(\Auth::user()->type!='super admin'): ?>
                <li class="<?php echo e((Request::segment(1) == 'calender')?'active open':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('calender.index')); ?>"><i class="fas fa-calendar"></i> <span><?php echo e(__('Calender')); ?></span></a>
                </li>
            <?php endif; ?>

            <li class="dropdown <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?' active':''); ?>">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-school"></i> <span>Inventory</span></a>
                        <ul class="dropdown-menu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?'display:block':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                <li class="<?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                    <a class="nav-link" href="#">Stock in</a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage client')): ?>
                                <li class="<?php echo e((Request::route()->getName() == 'clients.index' || Request::route()->getName() == 'clients.create' || Request::route()->getName() == 'clients.edit') ? ' active' : ''); ?>">
                                    <a class="nav-link" href="#">Stock out</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

<!-- 
            <?php if(Gate::check('manage plan')): ?>
                <li class="<?php echo e((Request::segment(1) == 'plans')?'active':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('plans.index')); ?>"><i class="fas fa-trophy"></i><span><?php echo e(__('Plan')); ?></span></a>
                </li>
            <?php endif; ?> -->

            <?php if(Gate::check('manage order')): ?>
                <li class="<?php echo e((Request::segment(1) == 'orders')?'active':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('order.index')); ?>"><i class="fas fa-cart-plus"></i><span><?php echo e(__('Order')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(Gate::check('manage note')): ?>
                <li class="<?php echo e((Request::segment(1) == 'notes')?'active':''); ?>">
                    <a class="nav-link" href="<?php echo e(route('notes.index')); ?>"><i class="fas fa-sticky-note"></i><span><?php echo e(__('Notes')); ?></span></a>
                </li>
            <?php endif; ?>


            <?php if((Gate::check('manage product') || Gate::check('manage invoice') || Gate::check('manage expense') || Gate::check('manage payment') || Gate::check('manage tax')) || \Auth::user()->type=='client'): ?>
                <li class="dropdown <?php echo e((Request::segment(1) == 'products' || Request::segment(1) == 'expenses' || Request::segment(1) == 'invoices' || Request::segment(1) == 'invoices-payments' || Request::segment(1) == 'taxes')?'active':''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-cart"></i> <span><?php echo e(__('Sales')); ?></span></a>
                    <ul class="dropdown-menu <?php echo e((Request::segment(1) == 'products' || Request::segment(1) == 'expenses' || Request::segment(1) == 'invoices' || Request::segment(1) == 'invoices-payments' || Request::segment(1) == 'taxes')?'display:block':''); ?>">

                        <?php if(Gate::check('manage invoice') || \Auth::user()->type=='client'): ?>
                            <li class="<?php echo e((Request::segment(1) == 'invoices')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('invoices.index')); ?>"><?php echo e(__('Invoice')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(Gate::check('manage payment') || \Auth::user()->type=='client'): ?>
                            <li class="<?php echo e((Request::segment(1) == 'invoices-payments')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('invoices.payments')); ?>"><?php echo e(__('Payment')); ?></a>
                            </li>

                        <?php endif; ?>

                        <?php if(Gate::check('manage expense') || \Auth::user()->type=='client'): ?>
                            <li class="<?php echo e((Request::segment(1) == 'expenses')?'active open':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('expenses.index')); ?>"><?php echo e(__('Expense')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage tax')): ?>
                            <li class="<?php echo e((Request::segment(1) == 'taxes')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('taxes.index')); ?>"><?php echo e(__('Tax Rates')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>


            <?php if(Gate::check('manage lead stage') || Gate::check('manage project stage') || Gate::check('manage lead source') || Gate::check('manage label') || Gate::check('manage expense category') || Gate::check('manage payment')): ?>
                <li class="dropdown <?php echo e((Request::segment(1) == 'leadstages' || Request::segment(1) == 'projectstages' ||  Request::segment(1) == 'leadsources' ||  Request::segment(1) == 'labels' ||  Request::segment(1) == 'productunits' ||  Request::segment(1) == 'expensescategory' ||  Request::segment(1) == 'payments' ||  Request::segment(1) == 'bugstatus')? 'active':''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Constant</span></a>
                    <ul class="dropdown-menu <?php echo e((Request::segment(1) == 'leadstages' || Request::segment(1) == 'projectstages' ||  Request::segment(1) == 'leadsources' ||  Request::segment(1) == 'labels' ||  Request::segment(1) == 'productunits' ||  Request::segment(1) == 'expensescategory' ||  Request::segment(1) == 'payments' ||  Request::segment(1) == 'bugstatus')? 'display:block':''); ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead stage')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'leadstages.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('leadstages.index')); ?>"> <?php echo e(__('Lead Stage')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project stage')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'projectstages.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('projectstages.index')); ?>"> <?php echo e(__('Project Stage')); ?></a>
                            </li>

                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead source')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'leadsources.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('leadsources.index')); ?>"><?php echo e(__('Lead Source')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage label')): ?>

                            <li class="<?php echo e((Request::route()->getName() == 'labels.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('labels.index')); ?>"> <?php echo e(__('Lable')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product unit')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'productunits.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('productunits.index')); ?>"><?php echo e(__('Product Unit')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage expense category')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'expensescategory.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('expensescategory.index')); ?>"><?php echo e(__('Expense Category')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payment')): ?>
                            <li class="<?php echo e((Request::route()->getName() == 'payments.index' ) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('payments.index')); ?>"><?php echo e(__('Payment Method')); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo e((Request::segment(1) == 'bugstatus')?'active open':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('bugstatus.index')); ?>"><?php echo e(__('Bug Status')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
<!-- 
            <?php if(Gate::check('manage system settings')): ?>
                <li class="<?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('systems.index')); ?>"><i class="fas fa-sliders-h"></i> <span><?php echo e(__('System Setting')); ?> </span></a>
                </li>
            <?php endif; ?>
            <?php if(Gate::check('manage company settings')): ?>
                <li class="<?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('company.setting')); ?>"><i class="fas fa-sliders-h"></i> <span><?php echo e(__('Company Setting')); ?> </span></a>
                </li>
            <?php endif; ?> -->

        </ul>
    </aside>
</div>
<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>