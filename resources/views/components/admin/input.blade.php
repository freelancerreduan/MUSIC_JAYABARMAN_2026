@props(['name', 'label' => null, 'value' => null, 'type' => 'text', 'hint' => null, 'full' => false])
@php $id = 'f_'.str_replace(['[', ']'], '_', $name); @endphp
<div @class(['field', 'full' => $full])>
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}" {{ $attributes->class(['input', 'is-invalid' => $errors->has($name)]) }}>
  @if ($hint)<div class="hint">{!! $hint !!}</div>@endif
  @error($name)<div class="error">{{ $message }}</div>@enderror
</div>
