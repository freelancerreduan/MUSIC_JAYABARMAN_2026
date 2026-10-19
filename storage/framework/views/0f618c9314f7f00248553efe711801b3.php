<?php
    $user = auth()->user();
    $menu = \App\Support\AdminMenu::build($user, $unreadCount);
    $crumb = \App\Support\AdminMenu::crumb($menu);
?>
<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> · <?php echo e(setting('site_name', 'Jaya Barman')); ?> Admin</title>
  <script>try { if (localStorage.getItem("admin-theme") === "dark") document.documentElement.dataset.theme = "dark"; } catch (e) {}</script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Bebas+Neue&family=Tiro+Bangla&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('admin-assets/admin.css')); ?>?v=<?php echo e(filemtime(public_path('admin-assets/admin.css'))); ?>" rel="stylesheet">
  <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>
<div class="app">
  <aside class="sidebar">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand">
      <div class="brand-mark"><?php echo e(Str::upper(setting('site_name', 'Jaya Barman'))); ?></div>
      <div class="brand-sub">Studio admin</div>
    </a>

    <nav class="side-nav">
      <div class="side-label">Main</div>
      <?php $__currentLoopData = $menu['main']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($item[2]); ?>" class="side-link <?php echo e($item[3] ? 'active' : ''); ?>" <?php if($item[5] ?? false): ?> target="_blank" <?php endif; ?>>
          <i class="bi bi-<?php echo e($item[1]); ?>"></i><?php echo e($item[0]); ?>

          <?php if($item[4] ?? 0): ?><span class="count"><?php echo e($item[4]); ?></span><?php elseif($item[5] ?? false): ?><i class="bi bi-box-arrow-up-right chev"></i><?php endif; ?>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <div class="side-label">Website sections <span class="side-hint">same as the site menu</span></div>
      <?php $__currentLoopData = $menu['website']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="side-group <?php echo e($section['open'] ? 'open' : ''); ?>">
          <button type="button" class="side-link <?php echo e($section['open'] ? 'active' : ''); ?>">
            <i class="bi bi-<?php echo e($section['icon']); ?>"></i><?php echo e($section['label']); ?>

            <?php if($section['badge']): ?><span class="count" style="margin-left:auto;margin-right:6px"><?php echo e($section['badge']); ?></span><?php endif; ?>
            <i class="bi bi-chevron-right chev" <?php if($section['badge']): ?> style="margin-left:0" <?php endif; ?>></i>
          </button>
          <div class="side-sub">
            <?php $__currentLoopData = $section['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e($child[1]); ?>" class="<?php echo e($child[2] ? 'active' : ''); ?>" title="<?php echo e($child[4]); ?>"><span class="side-no"><?php echo e($loop->iteration); ?></span><?php echo e($child[0]); ?><?php if($child[3] ?? 0): ?> <span class="count sm"><?php echo e($child[3]); ?></span><?php endif; ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($section['url']); ?>" target="_blank" class="side-view"><i class="bi bi-box-arrow-up-right"></i> View <?php echo e($section['label']); ?> page</a>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </nav>

    <div class="side-user">
      <span class="avatar"><?php echo e($user->initials()); ?></span>
      <div class="truncate">
        <strong class="truncate"><?php echo e($user->name); ?></strong>
        <small>Admin</small>
      </div>
      <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" title="Log out" aria-label="Log out"><i class="bi bi-box-arrow-right"></i></button>
      </form>
    </div>
  </aside>
  <div class="scrim" data-sidebar-toggle></div>

  <div class="main">
    <header class="topbar">
      <button class="icon-btn menu-btn" type="button" data-sidebar-toggle aria-label="Menu"><i class="bi bi-list"></i></button>
      <div class="topbar-title">
        <h1><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
        <p><?php if($crumb): ?><?php echo e($crumb['section']); ?> page · <?php echo e($crumb['item']); ?><?php else: ?> <?php echo $__env->yieldContent('subtitle', 'Website overview'); ?> <?php endif; ?></p>
      </div>

      <div class="topbar-actions">
        <button class="icon-btn" type="button" data-theme-toggle aria-label="Toggle dark mode"><i class="bi bi-moon theme-dark"></i><i class="bi bi-sun theme-light"></i></button>

        <div class="dropdown">
          <button class="icon-btn" type="button" data-dropdown aria-label="Notifications">
            <i class="bi bi-bell"></i>
            <?php if($unreadCount): ?><span class="dot"><?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?></span><?php endif; ?>
          </button>
          <div class="dropdown-menu notif-menu">
            <div class="dropdown-head">New messages</div>
            <?php $__empty_1 = true; $__currentLoopData = $unreadMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <a href="<?php echo e(route('admin.messages.show', $m)); ?>" class="notif-item">
                <span class="avatar sm"><?php echo e(mb_strtoupper(mb_substr($m->name, 0, 1))); ?></span>
                <span class="truncate"><strong><?php echo e($m->name); ?></strong><p class="truncate"><?php echo e($m->subject); ?> — <?php echo e(Str::limit($m->body, 50)); ?></p><small><?php echo e($m->created_at->diffForHumans()); ?></small></span>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <div class="empty" style="padding:18px"><i class="bi bi-inbox"></i>No new messages</div>
            <?php endif; ?>
            <div class="sep"></div>
            <a href="<?php echo e(route('admin.messages.index')); ?>"><i class="bi bi-envelope"></i>Open inbox</a>
          </div>
        </div>

        <div class="dropdown">
          <button class="user-chip" type="button" data-dropdown>
            <span class="avatar"><?php echo e($user->initials()); ?></span>
            <span class="who"><strong><?php echo e($user->name); ?></strong><small>Admin</small></span>
            <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <a href="<?php echo e(route('admin.profile')); ?>"><i class="bi bi-key"></i>Login &amp; password</a>
            <a href="<?php echo e(route('home')); ?>" target="_blank"><i class="bi bi-globe2"></i>View website</a>
            <div class="sep"></div>
            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit"><i class="bi bi-box-arrow-right"></i>Log out</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <main class="content">
      <?php if($crumb): ?>
        <div class="crumb">
          <span><i class="bi bi-<?php echo e($crumb['icon']); ?>"></i> Website <i class="bi bi-chevron-right"></i> <strong><?php echo e($crumb['section']); ?></strong> <i class="bi bi-chevron-right"></i> <?php echo e($crumb['item']); ?><small class="crumb-hint"><i class="bi bi-geo-alt"></i><?php echo e($crumb['hint']); ?></small></span>
          <a href="<?php echo e($crumb['url']); ?>" target="_blank" class="btn btn-sm"><i class="bi bi-box-arrow-up-right"></i>View <?php echo e($crumb['section']); ?> page</a>
        </div>
      <?php endif; ?>
      <?php if(session('success')): ?>
        <div class="flash" data-autohide><i class="bi bi-check-circle-fill"></i><?php echo e(session('success')); ?></div>
      <?php endif; ?>
      <?php if($errors->any()): ?>
        <div class="flash error"><i class="bi bi-exclamation-triangle-fill"></i>Please check the highlighted fields.</div>
      <?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="app-footer">&copy; <?php echo e(date('Y')); ?> <?php echo e(setting('site_name', 'Jaya Barman')); ?>. All rights reserved.</footer>
  </div>
</div>

<script src="<?php echo e(asset('admin-assets/admin.js')); ?>?v=<?php echo e(filemtime(public_path('admin-assets/admin.js'))); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/layouts/admin.blade.php ENDPATH**/ ?>