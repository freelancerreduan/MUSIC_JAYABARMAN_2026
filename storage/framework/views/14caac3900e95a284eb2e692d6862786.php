<form method="POST" action="<?php echo e($action); ?>" data-confirm="<?php echo e($confirm ?? 'Delete this item? This cannot be undone.'); ?>" style="display:inline">
  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
  <button class="btn btn-sm btn-icon btn-danger" type="submit" title="Delete" aria-label="Delete"><i class="bi bi-trash3"></i></button>
</form>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/partials/delete.blade.php ENDPATH**/ ?>