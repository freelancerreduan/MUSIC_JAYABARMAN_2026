<?php $__env->startSection('title', 'Performance'); ?>
<?php $__env->startSection('subtitle', 'Concerts and live shows'); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-head">
    <div>
      <h2>Performances</h2>
      <p>Concerts shown at the top of the Performance page. The featured one is “Latest” on the home page.</p>
    </div>
    <div class="actions">
      <a href="<?php echo e(route('admin.videos.index', ['place' => 'performance'])); ?>" class="btn"><i class="bi bi-camera-video"></i>Performance videos</a>
      <a href="<?php echo e(route('admin.concerts.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add performance</a>
    </div>
  </div>

  <div class="card">
    <?php if($concerts->isEmpty()): ?>
      <div class="empty"><i class="bi bi-music-note-beamed"></i>No performances yet.</div>
    <?php else: ?>
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Date</th><th>Location</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $concerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php if($concert->image): ?><img class="thumb" src="<?php echo e(thumb_url($concert->image)); ?>" alt=""><?php else: ?><span class="thumb video"><i class="bi bi-music-note"></i></span><?php endif; ?></td>
                <td><strong><?php echo e($concert->title); ?></strong><small><?php echo e($concert->eyebrow); ?></small></td>
                <td><?php echo e($concert->event_date?->format('d M Y') ?? '—'); ?></td>
                <td><?php echo e($concert->location ?: '—'); ?></td>
                <td>
                  <?php echo $__env->make('admin.partials.status', ['active' => $concert->is_active], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                  <?php if($concert->is_featured): ?><span class="badge tone-orange"><i class="bi bi-star-fill"></i>Featured</span><?php endif; ?>
                </td>
                <td class="num"><div class="row-actions">
                  <a href="<?php echo e(route('admin.concerts.edit', $concert)); ?>" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  <?php echo $__env->make('admin.partials.delete', ['action' => route('admin.concerts.destroy', $concert)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/concerts/index.blade.php ENDPATH**/ ?>