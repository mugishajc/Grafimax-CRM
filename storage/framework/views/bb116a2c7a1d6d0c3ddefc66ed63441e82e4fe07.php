<?php
    $users=\Auth::user();
    $profile=asset(Storage::url('avatar/'));
    $currantLang = $users->currentLanguage();
    $languages= Utility::languages();
?>
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto search-element" method="post">
        <?php echo csrf_field(); ?>
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        

    </form>

    <ul class="navbar-nav navbar-right">
<!--
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage language')): ?>
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg language-dd"><i class="fas fa-language"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header"><?php echo e(__('Choose Language')); ?>

                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create language')): ?>
                        <a href="<?php echo e(route('manage.language',[$currantLang])); ?>" class="dropdown-item btn manage-language-btn">
                            <span> <?php echo e(__('Create & Customize')); ?></span>
                        </a>
                    <?php endif; ?>

                    <div class="dropdown-list-content dropdown-list-icons">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language',$language)); ?>" class="dropdown-item dropdown-item-unread <?php if($language == $currantLang): ?> active-language <?php endif; ?>">
                                <span> <?php echo e(Str::upper($language)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </li>
        <?php endif; ?> -->

        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <!-- <img alt="image" src="<?php echo e((!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.jpg')); ?>" class="rounded-circle mr-1">
                 -->
                <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Hi')); ?>, <?php echo e(\Auth::user()->name); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Ikaze!</div>
                <a href="<?php echo e(route('profile')); ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> <?php echo e(__('My profile')); ?>

                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span><?php echo e(__('Logout')); ?></span>
                </a>
                <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>

            </div>
        </li>
    </ul>
</nav>

<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>