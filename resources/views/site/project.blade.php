@extends('layouts.site')

@section('title', $page->title.' | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  @if ($works->isNotEmpty())
    <section class="section-sm pt-2">
      <div class="container">
        <div class="row g-4">
          @foreach ($works as $work)
            <div class="col-md-6 reveal">
              <a href="{{ $work->link ?: '#' }}" class="discipline-card media-link" @if ($work->link) target="_blank" rel="noopener" @endif style="aspect-ratio:4/3">
                <img src="{{ media_url($work->image) }}" alt="{{ $work->title }}" @if ($work->image_position) style="object-position:{{ $work->image_position }}" @endif>
                @if ($work->link)<span class="media-link-icon"><i class="bi bi-box-arrow-up-right"></i></span>@endif
                <div class="overlay"><small>{{ $work->source }}</small><h3 @class(['bn' => $work->is_bangla])>{{ $work->title }}</h3></div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @if ($videos->isNotEmpty())
    <section class="section">
      <div class="container">
        <div class="text-center mb-5 reveal">
          <span class="eyebrow">Watch</span>
          <h2 class="section-title">Videos</h2>
          <div class="divider"></div>
        </div>
        <div class="row g-4 justify-content-center">
          @foreach ($videos as $video)
            <div class="col-md-6 col-lg-4 reveal">
              @include('site.partials.video-box')
              <h3 class="video-caption">{{ $video->title }}</h3>
              @if ($video->meta)<p class="video-meta">{{ $video->meta }}</p>@endif
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @if ($photos->isNotEmpty())
    <section class="section section-alt">
      <div class="container">
        <div class="text-center mb-5 reveal">
          <span class="eyebrow">Gallery</span>
          <h2 class="section-title">Photos</h2>
          <div class="divider"></div>
        </div>
        <div class="row g-3 g-lg-4">
          @foreach ($photos as $photo)
            <div class="col-6 col-lg-3 reveal">
              <a href="{{ media_url($photo->image) }}" class="gallery-item"><img src="{{ thumb_url($photo->image) }}" alt="{{ $photo->caption }}" loading="lazy"></a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    @include('site.partials.lightbox')
  @endif
@endsection
