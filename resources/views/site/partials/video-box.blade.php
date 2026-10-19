@if ($video->isExternal())
  <a class="video-box d-block" href="{{ $video->video_url }}" target="_blank" rel="noopener" @if ($video->poster) style="background:url('{{ media_url($video->poster) }}') center/cover" @endif>
    <span class="play"><span><i class="bi bi-box-arrow-up-right"></i></span></span>
  </a>
@else
  <div class="video-box">
    <video src="{{ media_url($video->video_url) }}#t=0.5" preload="metadata" playsinline @if ($video->poster) poster="{{ media_url($video->poster) }}" @endif></video>
    <button class="play" type="button" aria-label="Play {{ $video->title }}"><span><i class="bi bi-play-fill"></i></span></button>
  </div>
@endif
