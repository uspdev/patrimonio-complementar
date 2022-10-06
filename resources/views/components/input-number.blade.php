@props([
    'model' => '',
    'prepend' => '',
    'append' => '',
    'label' => '',
    'class' => '',
    'id' => 'input-number-' . mt_rand(1000000, 9999999),
])

<div class="form-group {{ $class }} wire-input-text">
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <input id="{{ $id }}" class="form-control" type="number"
      {{ $attributes }} title="@error($model){{ $message }}@enderror"
    />
    {{ $slot }}
    @if ($append)
      <div class="input-group-append">
        <div class="input-group-text">{!! $append !!}</div>
      </div>
    @endif
    {{-- <button class="btn bg-transparent clear-input" style="margin-left: -40px; z-index: 100;">
      <i class="fa fa-times"></i>
    </button> --}}
  </div>

    @error($model) <span class="small text-danger">{{ $message }}</span> @enderror
</div>
