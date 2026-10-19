

<?php $__env->startSection('content'); ?>
  <header class="hero" <?php if($page->hero_image): ?> style="background-image:url('<?php echo e(media_url($page->hero_image)); ?>')" <?php endif; ?>>
    <div class="container">
      <h1 class="hero-title reveal"><?php echo e($page->title); ?></h1>
      <div class="d-flex flex-wrap gap-3 justify-content-center reveal">
        <a href="<?php echo e(route('performance')); ?>" class="btn btn-gold"><i class="bi bi-play-fill me-2"></i>Performance</a>
        <a href="<?php echo e(route('about')); ?>" class="btn btn-ghost">About</a>
      </div>
    </div>
    <a href="#about" class="hero-scroll" aria-label="Scroll down"><i class="bi bi-chevron-double-down"></i></a>
  </header>

  <section id="about" class="section">
    <div class="container">
      <div class="row g-4 g-lg-5 align-items-center">
        <div class="col-lg-5 order-lg-2 reveal">
          <div class="portrait-wrap mx-auto" style="max-width:420px">
            <div class="portrait-frame rounded-4"><img class="rounded-4" src="<?php echo e(media_url(setting('portrait', 'assets/img/portrait.jpg'))); ?>" alt="Portrait of <?php echo e(setting('site_name')); ?>"></div>
          </div>
        </div>
        <div class="col-lg-7 order-lg-1 reveal">
          <span class="eyebrow">About the artist</span>
          <h2 class="intro-roles mb-4">Musician<span>|</span>Visual Artist<span>|</span>Actor</h2>
          <?php echo str_replace('<p', '<p class="lead-text"', paragraphs(setting('home_intro'), '')); ?>

          <a href="<?php echo e(route('about')); ?>" class="btn btn-gold mt-4">Full Profile <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </section>

  <?php if($latest): ?>
    <section class="section-sm">
      <div class="container">
        <div class="row g-4 g-lg-5 align-items-center">
          <div class="col-lg-6 reveal">
            <a href="<?php echo e(route('performance')); ?>#concert-<?php echo e($latest->id); ?>" class="video-card" style="aspect-ratio:16/10">
              <div class="bg" style="background-image:url('<?php echo e(media_url($latest->image ?: setting('portrait'))); ?>');background-position:50% 25%"></div>
              <div class="content">
                <div class="v-by"><?php echo e(collect([str($latest->location)->before(',')->value() ?: null, $latest->event_date?->format('j F Y')])->filter()->implode(' · ')); ?></div>
                <div class="v-play"><i class="bi bi-play-fill"></i></div>
              </div>
            </a>
          </div>
          <div class="col-lg-6 reveal">
            <span class="eyebrow">Latest</span>
            <h2 class="section-title"><?php echo e($latest->title); ?></h2>
            <p class="lead-text"><?php echo e($latest->excerpt); ?></p>
            <a href="<?php echo e(route('performance')); ?>" class="btn btn-gold mt-2">Performance <i class="bi bi-arrow-right ms-2"></i></a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/site/home.blade.php ENDPATH**/ ?>