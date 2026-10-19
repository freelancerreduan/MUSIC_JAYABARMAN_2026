@extends('layouts.site')

@section('title', $page->title.' | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  <section class="section-sm pt-2">
    <div class="container">
      @if ($items->isEmpty())
        @include('site.partials.empty', ['icon' => 'camera-video', 'text' => 'New videos will be added here soon.', 'link' => route('project'), 'label' => 'See Projects'])
      @else
        <div class="row g-4">
          @foreach ($items as $item)
            <div class="col-lg-6 reveal">
              <div class="media-card">
                @if ($item->embed_url)
                  <div class="embed"><iframe src="{{ $item->embed_url }}" title="{{ $item->source }} - {{ setting('site_name') }}" loading="lazy" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen></iframe></div>
                @endif
                <div class="body">
                  @if ($item->source)<div class="source">{{ $item->source }}</div>@endif
                  <h3>{{ $item->title }}</h3>
                  @if ($item->meta)<p class="meta">{{ $item->meta }}</p>@endif
                  @if ($item->link_url)
                    <a class="link" href="{{ $item->link_url }}" target="_blank" rel="noopener">{{ $item->link_label ?: 'Open' }} <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>
@endsection
