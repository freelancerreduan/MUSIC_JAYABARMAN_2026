<form method="POST" action="{{ $action }}" data-confirm="{{ $confirm ?? 'Delete this item? This cannot be undone.' }}" style="display:inline">
  @csrf @method('DELETE')
  <button class="btn btn-sm btn-icon btn-danger" type="submit" title="Delete" aria-label="Delete"><i class="bi bi-trash3"></i></button>
</form>
