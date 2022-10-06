@props([
    'model' => '',
    'prepend' => '',
    'append' => '',
    'label' => '',
    'class' => '',
    'id' => 'wire-input-textarea-' . mt_rand(1000000, 9999999),
])

<div class="form-group {{ $class }} wire-input-textarea">
  @if ($label)
    <label for="{{ $id }}">{{ $label }}</label>
  @endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{!! $prepend !!}</div>
      </div>
    @endif
    <textarea id="{{ $id }}" class="form-control" type="text" wire:dirty.class="border-danger"
      wire:model.lazy="{{ $model }}" {{ $attributes }} title="@error($model){{ $message }}@enderror"></textarea>
    {{ $slot }}
  </div>

  @error($model)
    <span class="small text-danger">{{ $message }}</span>
  @enderror
</div>

<style>
  .rotated {
    -ms-transform: rotate(270deg);
    /* IE 9 */
    -webkit-transform: rotate(270deg) !important;
    /* Chrome, Safari, Opera */
    transform: rotate(270deg);
  }
</style>

@Once


  @section('javascripts_bottom')
    @parent
    <script>
      $(function() {
        $('.wire-input-textarea').find('input').popover({
          html: true,
          placement: 'top'
        })

      })
    </script>
  @endsection

@endonce
