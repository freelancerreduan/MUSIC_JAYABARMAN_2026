@if ($paginator->total() > 0)
  <div class="pager">
    <span>Showing {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }}</span>
    @if ($paginator->hasPages())
      <div class="pages">
        @unless ($paginator->onFirstPage())<a class="btn btn-sm" href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>@endunless
        <span class="btn btn-sm" style="pointer-events:none">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
        @if ($paginator->hasMorePages())<a class="btn btn-sm" href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>@endif
      </div>
    @endif
  </div>
@endif
