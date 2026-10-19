<?php $__env->startSection('title', 'Featured work'); ?>
<?php $__env->startSection('subtitle', 'Project page'); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-head">
    <div><h2>Featured work</h2><p>The large cards at the top of the Project page. Each card opens its link in a new tab.</p></div>
    <div class="actions"><a href="<?php echo e(route('admin.works.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add card</a></div>
  </div>

  <div class="card">
    <?php if($works->isEmpty()): ?>
      <div class="empty"><i class="bi bi-collection-play"></i>No featured work yet.</div>
    <?php else: ?>
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Link</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><img class="thumb" src="<?php echo e(thumb_url($work->image)); ?>" alt=""></td>
                <td><strong class="<?php echo \Illuminate\Support\Arr::toCssClasses(['bn' => $work->is_bangla]); ?>"><?php echo e($work->title); ?></strong><small><?php echo e($work->source); ?></small></td>
                <td style="max-width:260px"><?php if($work->link): ?><a href="<?php echo e($work->link); ?>" target="_blank" rel="noopener" class="truncate" style="display:block"><?php echo e($work->link); ?></a><?php endif; ?></td>
                <td><?php echo $__env->make('admin.partials.status', ['active' => $work->is_active], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                <td class="num"><div class="row-actions">
                  <a href="<?php echo e(route('admin.works.edit', $work)); ?>" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  <?php echo $__env->make('admin.partials.delete', ['action' => route('admin.works.destroy', $work)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/works/index.blade.php ENDPATH**/ ?>