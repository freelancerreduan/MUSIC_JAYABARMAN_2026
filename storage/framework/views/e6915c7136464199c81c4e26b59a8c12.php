<?php $__env->startSection('title', $page->title.' | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="section-sm pt-2">
    <div class="container">
      <?php if($items->isEmpty()): ?>
        <?php echo $__env->make('site.partials.empty', ['icon' => 'camera-video', 'text' => 'New videos will be added here soon.', 'link' => route('project'), 'label' => 'See Projects'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php else: ?>
        <div class="row g-4">
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 reveal">
              <div class="media-card">
                <?php if($item->embed_url): ?>
                  <div class="embed"><iframe src="<?php echo e($item->embed_url); ?>" title="<?php echo e($item->source); ?> - <?php echo e(setting('site_name')); ?>" loading="lazy" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen></iframe></div>
                <?php endif; ?>
                <div class="body">
                  <?php if($item->source): ?><div class="source"><?php echo e($item->source); ?></div><?php endif; ?>
                  <h3><?php echo e($item->title); ?></h3>
                  <?php if($item->meta): ?><p class="meta"><?php echo e($item->meta); ?></p><?php endif; ?>
                  <?php if($item->link_url): ?>
                    <a class="link" href="<?php echo e($item->link_url); ?>" target="_blank" rel="noopener"><?php echo e($item->link_label ?: 'Open'); ?> <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/media.blade.php ENDPATH**/ ?>