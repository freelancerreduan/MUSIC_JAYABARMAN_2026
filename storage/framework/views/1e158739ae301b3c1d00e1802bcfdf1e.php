

<?php $__env->startSection('title', 'About | '.setting('site_name')); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('site.partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="section-sm pt-3">
    <div class="container">
      <div class="row g-4 g-lg-5 align-items-start">
        <div class="col-lg-5 reveal">
          <div class="portrait-wrap mx-auto" style="max-width:460px">
            <div class="portrait-frame rounded-4"><img class="rounded-4" src="<?php echo e(media_url(setting('portrait'))); ?>" alt="Portrait of <?php echo e(setting('site_name')); ?>"></div>
          </div>
        </div>
        <div class="col-lg-7 reveal">
          <h2 class="section-title mb-3">Personal Details</h2>
          <ul class="info-list mb-5">
            <li><i class="bi bi-person"></i><span>Name: <strong><?php echo e(Str::upper(setting('site_name'))); ?></strong></span></li>
            <li><i class="bi bi-stars"></i><span>Actor, Musician and Visual Artist</span></li>
            <?php if(setting('phone')): ?><li><i class="bi bi-whatsapp"></i><span>Cell and WhatsApp: <a href="tel:<?php echo e(setting('phone')); ?>"><strong><?php echo e(setting('phone')); ?></strong></a></span></li><?php endif; ?>
            <?php if(setting('email')): ?><li><i class="bi bi-envelope"></i><span>E-Mail: <a href="mailto:<?php echo e(setting('email')); ?>"><strong><?php echo e(setting('email')); ?></strong></a></span></li><?php endif; ?>
          </ul>
          <?php if($affiliations->isNotEmpty()): ?>
            <h2 class="section-title mb-3">Current Status</h2>
            <div class="row g-3">
              <?php $__currentLoopData = $affiliations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6">
                  <div class="status-card">
                    <h4><?php echo e($aff->role); ?></h4>
                    <p><?php echo nl2br(e($aff->organization)); ?></p>
                    <?php if($aff->url): ?><a href="<?php echo e($aff->url); ?>" target="_blank" rel="noopener" class="small"><?php echo e(preg_replace('#^https?://#', '', $aff->url)); ?></a><?php endif; ?>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section-sm">
    <div class="container">
      
      <div class="cv-masonry">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="cv-block reveal">
            <h2><?php if($section->icon): ?><i class="bi bi-<?php echo e($section->icon); ?>"></i><?php endif; ?><?php echo e($section->title); ?></h2>
            <?php $__currentLoopData = $section->blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($block->heading): ?><h3><?php echo e($block->heading); ?></h3><?php endif; ?>
              <?php switch($block->type):
                case ('chips'): ?>
                  <ul class="chip-list"><?php $__currentLoopData = $block->lines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($line); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                  <?php break; ?>
                <?php case ('text'): ?>
                  <?php $__currentLoopData = $block->lines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p class="<?php echo \Illuminate\Support\Arr::toCssClasses(['mb-0' => $loop->parent->last && $loop->last]); ?>"><?php echo e($line); ?></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php break; ?>
                <?php case ('links'): ?>
                  <div class="link-pills">
                    <?php $__currentLoopData = $block->pairs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $url]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <a href="<?php echo e($url); ?>" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i><?php echo e($label ?? preg_replace('#^https?://#', '', $url)); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <?php break; ?>
                <?php default: ?>
                  <ul class="timeline">
                    <?php $__currentLoopData = $block->pairs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$year, $text]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php if($year): ?><span class="year"><?php echo e($year); ?></span><?php endif; ?><?php echo e($text); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
              <?php endswitch; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/about.blade.php ENDPATH**/ ?>