

<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('subtitle', 'Manage your website'); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-head">
    <div>
      <h2><?php echo e($greeting); ?>, <?php echo e(auth()->user()->firstName()); ?></h2>
      <p>Each box is one page of your website. Its parts are listed top to bottom, the same order you see on the site.</p>
    </div>
    <a href="<?php echo e(route('home')); ?>" target="_blank" class="btn"><i class="bi bi-globe2"></i>View website</a>
  </div>

  <ol class="how-to">
    <li><span>1</span><div><strong>Find the page</strong><small>Same name as the website menu</small></div></li>
    <li><span>2</span><div><strong>Click the part to change</strong><small>Listed top to bottom, like on the page</small></div></li>
    <li><span>3</span><div><strong>Edit &amp; save</strong><small>Then click <i class="bi bi-box-arrow-up-right"></i> to see it live</small></div></li>
  </ol>

  <?php if($unread): ?>
    <a href="<?php echo e(route('admin.messages.index', ['filter' => 'unread'])); ?>" class="card mini tone-pink" style="margin-bottom:20px">
      <span class="mini-icon"><i class="bi bi-envelope-exclamation"></i></span>
      <span><strong><?php echo e($unread); ?> new <?php echo e(Str::plural('message', $unread)); ?></strong><span>Sent from the Contacts page. Click to read.</span></span>
    </a>
  <?php endif; ?>

  <div class="grid g-3 section-cards">
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="card section-card">
        <div class="section-card-head">
          <span class="list-icon tone-blue"><i class="bi bi-<?php echo e($section['icon']); ?>"></i></span>
          <h3><?php echo e($section['label']); ?> <small>page</small></h3>
          <a href="<?php echo e($section['url']); ?>" target="_blank" class="btn btn-sm" title="Open the <?php echo e($section['label']); ?> page on the website"><i class="bi bi-box-arrow-up-right"></i>View</a>
        </div>
        <div class="page-outline-label"><i class="bi bi-arrow-down"></i> Under the top banner</div>
        <ol class="page-outline">
          <?php $__currentLoopData = $section['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <a href="<?php echo e($child[1]); ?>">
                <span class="no"><?php echo e($loop->iteration); ?></span>
                <span class="what"><strong><?php echo e($child[0]); ?><?php if($child[3] ?? 0): ?> <span class="badge tone-pink"><?php echo e($child[3]); ?> new</span><?php endif; ?></strong><small><?php echo e($child[4]); ?></small></span>
                <span class="edit"><i class="bi bi-pencil"></i>Edit</span>
              </a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="card mt">
    <div class="card-head">
      <div><h3>Latest messages</h3><p>From the contact form on the Contacts page</p></div>
      <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-sm">All messages</a>
    </div>
    <?php if($messages->isEmpty()): ?>
      <div class="empty"><i class="bi bi-inbox"></i>No messages yet.</div>
    <?php else: ?>
      <ul class="list">
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <span class="avatar"><?php echo e(mb_strtoupper(mb_substr($m->name, 0, 1))); ?></span>
            <a href="<?php echo e(route('admin.messages.show', $m)); ?>" class="grow" style="color:inherit;min-width:0">
              <strong class="truncate"><?php echo e($m->name); ?> · <?php echo e($m->subject); ?></strong>
              <small class="truncate" style="display:block"><?php echo e($m->body); ?></small>
            </a>
            <small class="end"><?php echo e($m->created_at->diffForHumans()); ?></small>
            <?php if (! ($m->read_at)): ?><span class="badge dot tone-pink">New</span><?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jaya barman\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>