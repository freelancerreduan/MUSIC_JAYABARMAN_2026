<?php $__env->startSection('title', $page->title.' | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php if($works->isNotEmpty()): ?>
    <section class="section-sm pt-2">
      <div class="container">
        <div class="row g-4">
          <?php $__currentLoopData = $works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 reveal">
              <a href="<?php echo e($work->link ?: '#'); ?>" class="discipline-card media-link" <?php if($work->link): ?> target="_blank" rel="noopener" <?php endif; ?> style="aspect-ratio:4/3">
                <img src="<?php echo e(media_url($work->image)); ?>" alt="<?php echo e($work->title); ?>" <?php if($work->image_position): ?> style="object-position:<?php echo e($work->image_position); ?>" <?php endif; ?>>
                <?php if($work->link): ?><span class="media-link-icon"><i class="bi bi-box-arrow-up-right"></i></span><?php endif; ?>
                <div class="overlay"><small><?php echo e($work->source); ?></small><h3 class="<?php echo \Illuminate\Support\Arr::toCssClasses(['bn' => $work->is_bangla]); ?>"><?php echo e($work->title); ?></h3></div>
              </a>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($videos->isNotEmpty()): ?>
    <section class="section">
      <div class="container">
        <div class="text-center mb-5 reveal">
          <span class="eyebrow">Watch</span>
          <h2 class="section-title">Videos</h2>
          <div class="divider"></div>
        </div>
        <div class="row g-4 justify-content-center">
          <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 reveal">
              <?php echo $__env->make('site.partials.video-box', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              <h3 class="video-caption"><?php echo e($video->title); ?></h3>
              <?php if($video->meta): ?><p class="video-meta"><?php echo e($video->meta); ?></p><?php endif; ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($photos->isNotEmpty()): ?>
    <section class="section section-alt">
      <div class="container">
        <div class="text-center mb-5 reveal">
          <span class="eyebrow">Gallery</span>
          <h2 class="section-title">Photos</h2>
          <div class="divider"></div>
        </div>
        <div class="row g-3 g-lg-4">
          <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-lg-3 reveal">
              <a href="<?php echo e(media_url($photo->image)); ?>" class="gallery-item"><img src="<?php echo e(thumb_url($photo->image)); ?>" alt="<?php echo e($photo->caption); ?>" loading="lazy"></a>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
    <?php echo $__env->make('site.partials.lightbox', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/project.blade.php ENDPATH**/ ?>