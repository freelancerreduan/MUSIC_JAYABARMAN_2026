@extends('layouts.site')

@section('title', $page->title.' | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  <section class="section-sm pt-2">
    <div class="container">
      @if ($photos->isEmpty())
        @include('site.partials.empty', ['icon' => 'images', 'text' => 'New portfolio work is being prepared and will be added here soon.', 'link' => route('project'), 'label' => 'See Projects'])
      @else
        @if ($tags->count() > 1)
          <div class="filter-btns text-center mb-4 reveal">
            <button class="btn active" data-filter="all">All</button>
            @foreach ($tags as $tag)
              <button class="btn" data-filter="{{ Str::slug($tag) }}">{{ $tag }}</button>
            @endforeach
          </div>
        @endif
        <div class="row g-3 g-lg-4">
          @foreach ($photos as $photo)
            <div class="col-6 col-lg-4 reveal" data-cat="{{ Str::slug($photo->tag) }}">
              <a href="{{ media_url($photo->image) }}" class="gallery-item"><img src="{{ thumb_url($photo->image) }}" alt="{{ $photo->caption }}" loading="lazy"></a>
            </div>
          @endforeach
        </div>
        @include('site.partials.lightbox')
      @endif
    </div>
  </section>
@endsection
