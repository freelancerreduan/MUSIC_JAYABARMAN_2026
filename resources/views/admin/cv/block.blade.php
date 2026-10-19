<div class="repeat-item">
  <div class="repeat-head">
    <span><i class="bi bi-list-ul"></i> List</span>
    <button type="button" class="btn btn-sm btn-danger" data-repeat-remove><i class="bi bi-x-lg"></i>Remove</button>
  </div>
  <input type="hidden" name="blocks[{{ $i }}][id]" value="{{ $block['id'] ?? '' }}">
  <div class="form-grid">
    <div class="field">
      <label>Style</label>
      <select class="select" name="blocks[{{ $i }}][type]">
        @foreach (\App\Models\CvBlock::TYPES as $key => $label)
          <option value="{{ $key }}" @selected(($block['type'] ?? 'timeline') === $key)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="field">
      <label>Small heading above the list (optional)</label>
      <input class="input" name="blocks[{{ $i }}][heading]" value="{{ $block['heading'] ?? '' }}" placeholder="Leave empty if not needed">
    </div>
    <div class="field full">
      <label>Items, one per line</label>
      <textarea class="textarea" rows="8" name="blocks[{{ $i }}][content]" placeholder="2003 | Workshop on puppet making, Edinburgh">{{ $block['content'] ?? '' }}</textarea>
      <div class="hint">For years write <b>2003 | text</b>. See the examples on the right.</div>
    </div>
  </div>
</div>
