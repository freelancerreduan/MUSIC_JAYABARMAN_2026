<?php $__env->startSection('title', 'Videos'); ?>
<?php $__env->startSection('subtitle', 'Project and Performance videos'); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-head">
    <div>
      <h2>Videos</h2>
      <p>Choose where each video appears: the Project page grid, the Performance page, or both.</p>
    </div>
    <div class="actions">
      <div class="tabs">
        <a href="<?php echo e(route('admin.videos.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => ! request('place')]); ?>">All</a>
        <a href="<?php echo e(route('admin.videos.index', ['place' => 'project'])); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request('place') === 'project']); ?>">Project</a>
        <a href="<?php echo e(route('admin.videos.index', ['place' => 'performance'])); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request('place') === 'performance']); ?>">Performance</a>
      </div>
      <a href="<?php echo e(route('admin.videos.create', ['place' => request('place')])); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add video</a>
    </div>
  </div>

  <div class="card">
    <?php if($videos->isEmpty()): ?>
      <div class="empty"><i class="bi bi-camera-video"></i>No videos here yet.</div>
    <?php else: ?>
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Shown on</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <?php if($video->poster): ?><img class="thumb" src="<?php echo e(thumb_url($video->poster)); ?>" alt="">
                  <?php else: ?><span class="thumb video"><i class="bi bi-<?php echo e($video->isExternal() ? 'link-45deg' : 'play-btn'); ?>"></i></span><?php endif; ?>
                </td>
                <td><strong><?php echo e($video->title); ?></strong><small><?php echo e($video->meta ?: $video->video_url); ?></small></td>
                <td>
                  <?php if($video->in_project): ?><span class="badge tone-blue">Project</span><?php endif; ?>
                  <?php if($video->in_performance): ?><span class="badge tone-violet">Performance</span><?php endif; ?>
                </td>
                <td><?php echo $__env->make('admin.partials.status', ['active' => $video->is_active], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                <td class="num"><div class="row-actions">
                  <a href="<?php echo e(media_url($video->video_url)); ?>" target="_blank" class="btn btn-sm btn-icon" title="Open"><i class="bi bi-play-fill"></i></a>
                  <a href="<?php echo e(route('admin.videos.edit', [$video, 'place' => request('place')])); ?>" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  <?php echo $__env->make('admin.partials.delete', ['action' => route('admin.videos.destroy', $video)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/videos/index.blade.php ENDPATH**/ ?>