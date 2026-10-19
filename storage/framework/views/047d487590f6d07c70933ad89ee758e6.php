<?php if($video->isExternal()): ?>
  <a class="video-box d-block" href="<?php echo e($video->video_url); ?>" target="_blank" rel="noopener" <?php if($video->poster): ?> style="background:url('<?php echo e(media_url($video->poster)); ?>') center/cover" <?php endif; ?>>
    <span class="play"><span><i class="bi bi-box-arrow-up-right"></i></span></span>
  </a>
<?php else: ?>
  <div class="video-box">
    <video src="<?php echo e(media_url($video->video_url)); ?>#t=0.5" preload="metadata" playsinline <?php if($video->poster): ?> poster="<?php echo e(media_url($video->poster)); ?>" <?php endif; ?>></video>
    <button class="play" type="button" aria-label="Play <?php echo e($video->title); ?>"><span><i class="bi bi-play-fill"></i></span></button>
  </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/site/partials/video-box.blade.php ENDPATH**/ ?>