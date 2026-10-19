<header class="page-hero">
  <?php if($page->hero_image): ?>
    <div class="page-hero-bg" style="background-image:url('<?php echo e(media_url($page->hero_image)); ?>');<?php echo e($page->hero_position ? 'background-position:'.$page->hero_position : ''); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <?php if($page->eyebrow): ?><span class="eyebrow"><?php echo e($page->eyebrow); ?></span><?php endif; ?>
    <h1><?php echo e($page->title); ?></h1>
    <div class="divider"></div>
    <?php if($page->subtitle): ?>
      <p class="text-muted-2 mt-3 mb-0 mx-auto" style="max-width:620px"><?php echo e($page->subtitle); ?></p>
    <?php endif; ?>
  </div>
</header>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/site/partials/hero.blade.php ENDPATH**/ ?>