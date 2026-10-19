<?php if($active): ?>
  <span class="badge dot tone-green"><?php echo e($on ?? 'Published'); ?></span>
<?php else: ?>
  <span class="badge dot"><?php echo e($off ?? 'Hidden'); ?></span>
<?php endif; ?>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/partials/status.blade.php ENDPATH**/ ?>