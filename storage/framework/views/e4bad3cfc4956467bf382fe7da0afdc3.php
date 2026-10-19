<?php $__env->startSection('title', $page->title.' | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="section-sm pt-2">
    <div class="container">
      <?php if($items->isEmpty()): ?>
        <?php echo $__env->make('site.partials.empty', ['icon' => 'archive', 'text' => 'Older performances, exhibitions and press will be added here.', 'link' => route('about'), 'label' => 'Full CV'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php else: ?>
        <div class="row g-4">
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 reveal">
              <div class="project-card">
                <?php if($item->image): ?><img src="<?php echo e(thumb_url($item->image)); ?>" alt="<?php echo e($item->title); ?>" loading="lazy"><?php endif; ?>
                <div class="body">
                  <?php if($item->year): ?><div class="yr"><?php echo e($item->year); ?></div><?php endif; ?>
                  <h3><?php echo e($item->title); ?></h3>
                  <?php if($item->description): ?><p><?php echo e($item->description); ?></p><?php endif; ?>
                  <?php if($item->link): ?><a href="<?php echo e($item->link); ?>" target="_blank" rel="noopener" class="small d-inline-block mt-3">Open <i class="bi bi-box-arrow-up-right ms-1"></i></a><?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/archive.blade.php ENDPATH**/ ?>