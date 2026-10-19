<header class="page-hero">
  @if ($page->hero_image)
    <div class="page-hero-bg" style="background-image:url('{{ media_url($page->hero_image) }}');{{ $page->hero_position ? 'background-position:'.$page->hero_position : '' }}"></div>
  @endif
  <div class="container">
    @if ($page->eyebrow)<span class="eyebrow">{{ $page->eyebrow }}</span>@endif
    <h1>{{ $page->title }}</h1>
    <div class="divider"></div>
    @if ($page->subtitle)
      <p class="text-muted-2 mt-3 mb-0 mx-auto" style="max-width:620px">{{ $page->subtitle }}</p>
    @endif
  </div>
</header>
