<?php $about = request('section') === 'about'; ?>
<?php $__env->startSection('title', $about ? 'About · Photo' : 'Home · About the artist'); ?>

<?php $__env->startSection('content'); ?>
  <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.home-about', ['section' => request('section')])); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <div class="page-head">
      <div>
        <h2><?php echo e($about ? 'Photo (About page)' : 'About the artist (Home page)'); ?></h2>
        <p><?php echo e($about ? 'The photo next to Personal Details. The same photo is used on the Home page.' : 'The text and photo below the big banner on the Home page. The photo is also used on the About page.'); ?></p>
      </div>
      <div class="actions"><button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button></div>
    </div>

    <div class="grid <?php echo e($about ? '' : 'g-form'); ?>" <?php if($about): ?> style="max-width:480px" <?php endif; ?>>
      <?php if (! ($about)): ?>
        <div class="card">
          <div class="card-head"><h3>Description</h3></div>
          <div class="card-body form-grid">
            <?php if (isset($component)) { $__componentOriginal694712473b787cd740db4e46be9da3f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal694712473b787cd740db4e46be9da3f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.textarea','data' => ['name' => 'home_intro','label' => 'Text about the artist','value' => plain_paragraphs(setting('home_intro')),'rows' => '16','hint' => 'Leave one empty line between paragraphs. **word** = bold.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'home_intro','label' => 'Text about the artist','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(plain_paragraphs(setting('home_intro'))),'rows' => '16','hint' => 'Leave one empty line between paragraphs. **word** = bold.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $attributes = $__attributesOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__attributesOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $component = $__componentOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__componentOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="card">
        <div class="card-head"><h3>Photo</h3></div>
        <div class="card-body" style="display:grid;gap:14px">
          <?php if(setting('portrait')): ?><img src="<?php echo e(media_url(setting('portrait'))); ?>" alt="" style="border-radius:12px;width:100%;aspect-ratio:4/5;object-fit:cover"><?php endif; ?>
          <?php if (isset($component)) { $__componentOriginald7a44942e94dec8720e2550239b03147 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald7a44942e94dec8720e2550239b03147 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.media','data' => ['name' => 'portrait','value' => setting('portrait'),'hint' => 'A tall (portrait) photo works best.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'portrait','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(setting('portrait')),'hint' => 'A tall (portrait) photo works best.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald7a44942e94dec8720e2550239b03147)): ?>
<?php $attributes = $__attributesOriginald7a44942e94dec8720e2550239b03147; ?>
<?php unset($__attributesOriginald7a44942e94dec8720e2550239b03147); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald7a44942e94dec8720e2550239b03147)): ?>
<?php $component = $__componentOriginald7a44942e94dec8720e2550239b03147; ?>
<?php unset($__componentOriginald7a44942e94dec8720e2550239b03147); ?>
<?php endif; ?>
        </div>
      </div>
    </div>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/home-about.blade.php ENDPATH**/ ?>