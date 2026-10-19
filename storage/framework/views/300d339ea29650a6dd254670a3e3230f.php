

<?php $__env->startSection('title', $page->title.' | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php $__currentLoopData = $concerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section class="section-sm <?php echo e($loop->first ? 'pt-2' : 'pt-0'); ?>">
      <div class="container">
        <div class="concert-box reveal" id="concert-<?php echo e($concert->id); ?>">
          <div class="row g-4 g-lg-5">
            <div class="col-lg-4">
              <?php if($concert->eyebrow): ?><span class="eyebrow"><?php echo e($concert->eyebrow); ?></span><?php endif; ?>
              <h2><?php echo e($concert->title); ?></h2>
              <ul class="concert-meta">
                <?php if($concert->event_date): ?><li><i class="bi bi-calendar-event"></i><?php echo e($concert->event_date->format('j F Y')); ?></li><?php endif; ?>
                <?php if($concert->location): ?><li><i class="bi bi-geo-alt"></i><?php echo e($concert->location); ?></li><?php endif; ?>
                <?php if($concert->genres): ?><li><i class="bi bi-music-note-list"></i><?php echo e($concert->genres); ?></li><?php endif; ?>
              </ul>
              <?php if($concert->image): ?>
                <figure class="concert-photo">
                  <img src="<?php echo e(media_url($concert->image)); ?>" alt="<?php echo e($concert->title); ?>" loading="lazy">
                </figure>
              <?php endif; ?>
            </div>
            <div class="col-lg-8">
              <?php echo paragraphs($concert->body, ''); ?>

            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <section class="section-sm pt-0">
    <div class="container">
      <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row g-4 g-lg-5 align-items-center perf-item" id="video-<?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?>">
          <div class="col-lg-7 <?php echo e($loop->even ? 'order-lg-2' : ''); ?> reveal">
            <?php echo $__env->make('site.partials.video-box', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          </div>
          <div class="col-lg-5 reveal">
            <span class="perf-num">Video <?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
            <h2><?php echo e($video->title); ?></h2>
            <?php if($video->title_bn): ?><p class="perf-bn"><?php echo e($video->title_bn); ?></p><?php endif; ?>
            <div class="perf-body"><?php echo paragraphs($video->body); ?></div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/performance.blade.php ENDPATH**/ ?>