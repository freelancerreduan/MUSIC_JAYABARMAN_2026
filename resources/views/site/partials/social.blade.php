<div class="social">
  @foreach (['facebook' => 'Facebook', 'instagram' => 'Instagram', 'spotify' => 'Spotify', 'youtube' => 'YouTube'] as $key => $label)
    @if (setting($key))
      <a href="{{ setting($key) }}" target="_blank" rel="noopener" aria-label="{{ $label }}"><i class="bi bi-{{ $key }}"></i></a>
    @endif
  @endforeach
  @if (setting('whatsapp'))
    <a href="https://wa.me/{{ preg_replace('/\D/', '', setting('whatsapp')) }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
  @endif
</div>
