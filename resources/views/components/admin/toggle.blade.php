@props(['name', 'label', 'checked' => false, 'hint' => null])
<div class="field">
  <input type="hidden" name="{{ $name }}" value="0">
  <label class="switch"><input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked))> {{ $label }}</label>
  @if ($hint)<div class="hint">{{ $hint }}</div>@endif
</div>
