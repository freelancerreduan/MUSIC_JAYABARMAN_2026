<?php $__env->startSection('title', $page->title.' | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="section-sm pt-2">
    <div class="container">
      <?php if($photos->isEmpty()): ?>
        <?php echo $__env->make('site.partials.empty', ['icon' => 'images', 'text' => 'New portfolio work is being prepared and will be added here soon.', 'link' => route('project'), 'label' => 'See Projects'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php else: ?>
        <?php if($tags->count() > 1): ?>
          <div class="filter-btns text-center mb-4 reveal">
            <button class="btn active" data-filter="all">All</button>
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <button class="btn" data-filter="<?php echo e(Str::slug($tag)); ?>"><?php echo e($tag); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
        <div class="row g-3 g-lg-4">
          <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-lg-4 reveal" data-cat="<?php echo e(Str::slug($photo->tag)); ?>">
              <a href="<?php echo e(media_url($photo->image)); ?>" class="gallery-item"><img src="<?php echo e(thumb_url($photo->image)); ?>" alt="<?php echo e($photo->caption); ?>" loading="lazy"></a>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo $__env->make('site.partials.lightbox', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php endif; ?>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/portfolio.blade.php ENDPATH**/ ?>