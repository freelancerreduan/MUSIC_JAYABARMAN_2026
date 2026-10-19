@props(['name', 'label' => null, 'options' => [], 'value' => null, 'hint' => null, 'full' => false])
@php $id = 'f_'.$name; $current = (string) old($name, $value); @endphp
<div @class(['field', 'full' => $full])>
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->class(['select', 'is-invalid' => $errors->has($name)]) }}>
    @foreach ($options as $key => $text)
      <option value="{{ $key }}" @selected($current === (string) $key)>{{ $text }}</option>
    @endforeach
  </select>
  @if ($hint)<div class="hint">{!! $hint !!}</div>@endif
  @error($name)<div class="error">{{ $message }}</div>@enderror
</div>
