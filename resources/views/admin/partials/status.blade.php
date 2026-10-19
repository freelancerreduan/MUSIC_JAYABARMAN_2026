@if ($active)
  <span class="badge dot tone-green">{{ $on ?? 'Published' }}</span>
@else
  <span class="badge dot">{{ $off ?? 'Hidden' }}</span>
@endif
