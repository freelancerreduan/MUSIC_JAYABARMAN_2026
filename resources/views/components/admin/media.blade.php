@props(['name', 'label' => null, 'value' => null, 'hint' => null, 'video' => false, 'full' => true])
@php
  $current = old($name, $value);
  // Videos: either an uploaded file or a link, never both. A saved http(s) value means "link".
  $isLink = $video && preg_match('#^(https?:)?//#', (string) $current);
  $mode = old($name.'_mode', $isLink ? 'link' : 'file');
@endphp
<div @class(['field', 'full' => $full])>
  @if ($label)<span class="label">{{ $label }}</span>@endif

  @if ($video)
    <div class="video-source" data-video-source>
      <div class="source-tabs" role="radiogroup">
        <label><input type="radio" name="{{ $name }}_mode" value="file" @checked($mode === 'file')><span><i class="bi bi-upload"></i>Upload a video file</span></label>
        <label><input type="radio" name="{{ $name }}_mode" value="link" @checked($mode === 'link')><span><i class="bi bi-link-45deg"></i>Paste a video link</span></label>
      </div>

      <div class="source-panel" data-mode="file" @if ($mode !== 'file') hidden @endif>
        <input type="file" name="{{ $name }}_file" accept="video/mp4,video/webm,video/ogg,video/quicktime" @class(['input', 'is-invalid' => $errors->has($name.'_file')]) @disabled($mode !== 'file')>
        {{-- keeps the saved file when no new one is chosen --}}
        <input type="hidden" name="{{ $name }}" value="{{ $isLink ? '' : $current }}" @disabled($mode !== 'file')>
        @if ($current && ! $isLink)
          <div class="source-current"><i class="bi bi-camera-video"></i><span>Current file: <b>{{ basename($current) }}</b>. Choose a new file only to replace it.</span></div>
        @endif
        <div class="hint">MP4 works best.</div>
      </div>

      <div class="source-panel" data-mode="link" @if ($mode !== 'link') hidden @endif>
        <input type="url" name="{{ $name }}" value="{{ $isLink ? $current : '' }}" placeholder="https://www.youtube.com/watch?v=…  or  https://www.facebook.com/…" @class(['input', 'is-invalid' => $errors->has($name)]) @disabled($mode !== 'link')>
        <div class="hint">YouTube, Facebook or any video link. Visitors open it in a new tab.</div>
      </div>
    </div>
  @else
    <div class="media-field" data-base="{{ asset('') }}">
      <div @class(['media-preview', 'has-img' => $current]) @if ($current) style="background-image:url('{{ media_url($current) }}')" @endif><i class="bi bi-image"></i></div>
      <div class="stack">
        <input type="file" name="{{ $name }}_file" accept="image/*" @class(['input', 'is-invalid' => $errors->has($name.'_file')])>
        <input type="text" name="{{ $name }}" value="{{ $current }}" placeholder="or a path / URL, e.g. assets/img/photo.jpg" @class(['input', 'is-invalid' => $errors->has($name)])>
      </div>
    </div>
  @endif

  @if ($hint)<div class="hint">{!! $hint !!}</div>@endif
  @error($name)<div class="error">{{ $message }}</div>@enderror
  @error($name.'_file')<div class="error">{{ $message }}</div>@enderror
</div>
