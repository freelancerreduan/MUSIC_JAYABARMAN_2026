<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name', 'label' => null, 'value' => null, 'hint' => null, 'video' => false, 'full' => true]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['name', 'label' => null, 'value' => null, 'hint' => null, 'video' => false, 'full' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
  $current = old($name, $value);
  // Videos: either an uploaded file or a link, never both. A saved http(s) value means "link".
  $isLink = $video && preg_match('#^(https?:)?//#', (string) $current);
  $mode = old($name.'_mode', $isLink ? 'link' : 'file');
?>
<div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['field', 'full' => $full]); ?>">
  <?php if($label): ?><span class="label"><?php echo e($label); ?></span><?php endif; ?>

  <?php if($video): ?>
    <div class="video-source" data-video-source>
      <div class="source-tabs" role="radiogroup">
        <label><input type="radio" name="<?php echo e($name); ?>_mode" value="file" <?php if($mode === 'file'): echo 'checked'; endif; ?>><span><i class="bi bi-upload"></i>Upload a video file</span></label>
        <label><input type="radio" name="<?php echo e($name); ?>_mode" value="link" <?php if($mode === 'link'): echo 'checked'; endif; ?>><span><i class="bi bi-link-45deg"></i>Paste a video link</span></label>
      </div>

      <div class="source-panel" data-mode="file" <?php if($mode !== 'file'): ?> hidden <?php endif; ?>>
        <input type="file" name="<?php echo e($name); ?>_file" accept="video/mp4,video/webm,video/ogg,video/quicktime" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['input', 'is-invalid' => $errors->has($name.'_file')]); ?>" <?php if($mode !== 'file'): echo 'disabled'; endif; ?>>
        
        <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($isLink ? '' : $current); ?>" <?php if($mode !== 'file'): echo 'disabled'; endif; ?>>
        <?php if($current && ! $isLink): ?>
          <div class="source-current"><i class="bi bi-camera-video"></i><span>Current file: <b><?php echo e(basename($current)); ?></b>. Choose a new file only to replace it.</span></div>
        <?php endif; ?>
        <div class="hint">MP4 works best.</div>
      </div>

      <div class="source-panel" data-mode="link" <?php if($mode !== 'link'): ?> hidden <?php endif; ?>>
        <input type="url" name="<?php echo e($name); ?>" value="<?php echo e($isLink ? $current : ''); ?>" placeholder="https://www.youtube.com/watch?v=…  or  https://www.facebook.com/…" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['input', 'is-invalid' => $errors->has($name)]); ?>" <?php if($mode !== 'link'): echo 'disabled'; endif; ?>>
        <div class="hint">YouTube, Facebook or any video link. Visitors open it in a new tab.</div>
      </div>
    </div>
  <?php else: ?>
    <div class="media-field" data-base="<?php echo e(asset('')); ?>">
      <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['media-preview', 'has-img' => $current]); ?>" <?php if($current): ?> style="background-image:url('<?php echo e(media_url($current)); ?>')" <?php endif; ?>><i class="bi bi-image"></i></div>
      <div class="stack">
        <input type="file" name="<?php echo e($name); ?>_file" accept="image/*" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['input', 'is-invalid' => $errors->has($name.'_file')]); ?>">
        <input type="text" name="<?php echo e($name); ?>" value="<?php echo e($current); ?>" placeholder="or a path / URL, e.g. assets/img/photo.jpg" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['input', 'is-invalid' => $errors->has($name)]); ?>">
      </div>
    </div>
  <?php endif; ?>

  <?php if($hint): ?><div class="hint"><?php echo $hint; ?></div><?php endif; ?>
  <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  <?php $__errorArgs = [$name.'_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\laragon\www\jaya barman\resources\views/components/admin/media.blade.php ENDPATH**/ ?>