@props(['name', 'label' => null, 'value' => null, 'rows' => 4, 'hint' => null, 'full' => true, 'code' => false])
@php $id = 'f_'.str_replace(['[', ']'], '_', $name); @endphp
<div @class(['field', 'full' => $full])>
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" {{ $attributes->class(['textarea', 'code' => $code, 'is-invalid' => $errors->has($name)]) }}>{{ old($name, $value) }}</textarea>
  @if ($hint)<div class="hint">{!! $hint !!}</div>@endif
  @error($name)<div class="error">{{ $message }}</div>@enderror
</div>
