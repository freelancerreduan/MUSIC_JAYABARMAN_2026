<?php $siteName = setting('site_name', 'Jaya Barman'); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title', $siteName); ?></title>
  <meta name="description" content="<?php echo e($page->meta_description ?? setting('meta_description')); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Tiro+Bangla&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets/css/style.css')); ?>?v=<?php echo e(filemtime(public_path('assets/css/style.css'))); ?>" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top site-nav" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand brand-name d-lg-none" href="<?php echo e(route('home')); ?>"><?php echo e($siteName); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="mainNav">
        <ul class="navbar-nav align-items-lg-center">
          <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $active = request()->routeIs($navPage->routeName()); ?>
            <li class="nav-item"><a class="nav-link <?php echo e($active ? 'active' : ''); ?>" <?php if($active): ?> aria-current="page" <?php endif; ?> href="<?php echo e($navPage->url()); ?>"><?php echo e($navPage->nav_label); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php echo $__env->yieldContent('content'); ?>

  <footer class="site-footer">
    <div class="container">
      <p class="font-display fs-4 text-white mb-3"><?php echo e($siteName); ?></p>
      <?php echo $__env->make('site.partials.social', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <nav class="footer-links my-4">
        <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e($navPage->url()); ?>"><?php echo e($navPage->nav_label); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </nav>
      <p class="copyright mb-1">&copy; <?php echo e(date('Y')); ?> <?php echo e($siteName); ?>. All rights reserved.</p>
      <?php if(setting('footer_credit_text')): ?>
        <p class="copyright mb-0">Developed by <a href="<?php echo e(setting('footer_credit_url', '#')); ?>" class="dev-credit" target="_blank" rel="noopener"><?php echo e(setting('footer_credit_text')); ?></a></p>
      <?php endif; ?>
    </div>
  </footer>

  <button class="back-top" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

  <?php echo $__env->yieldPushContent('modals'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('assets/js/main.js')); ?>?v=<?php echo e(filemtime(public_path('assets/js/main.js'))); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/layouts/site.blade.php ENDPATH**/ ?>