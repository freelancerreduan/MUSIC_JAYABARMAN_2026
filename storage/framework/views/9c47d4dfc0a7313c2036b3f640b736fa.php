<div class="social">
  <?php $__currentLoopData = ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'spotify' => 'Spotify', 'youtube' => 'YouTube']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(setting($key)): ?>
      <a href="<?php echo e(setting($key)); ?>" target="_blank" rel="noopener" aria-label="<?php echo e($label); ?>"><i class="bi bi-<?php echo e($key); ?>"></i></a>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php if(setting('whatsapp')): ?>
    <a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', setting('whatsapp'))); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
  <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/site/partials/social.blade.php ENDPATH**/ ?>