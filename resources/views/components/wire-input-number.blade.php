@props([
    'model' => '',
    'prepend' => '',
    'append' => '',
    'label' => '',
    'class' => '',
    'id' => mt_rand(1000000, 9999999),
])

<div class="form-group {{ $class }} wire-input-text">
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{!! $prepend !!}</div>
      </div>
    @endif
    <input id="{{ $id }}" class="form-control" type="number"
      wire:dirty.class="border-danger" 
      wire:model.lazy="{{ $model }}" 
      {{ $attributes }} title="@error($model){{ $message }}@enderror" 
    />
    {{ $slot }}
    {{-- <button class="btn bg-transparent" wire:click="$set('{{ $model }}','')" style="margin-left: -40px; z-index: 100;">
      <i class="fa fa-times"></i>
    </button> --}}
  </div>

    @error($model) <span class="small text-danger">{{ $message }}</span> @enderror
  </div>

  @Once

    @section('styles')
      <style>
        .border-red-500 {}

      </style>
    @endsection

    @section('javascripts_bottom')
      @parent
      <script>
        $(function() {
          $('.wire-input-text').find('input').popover({
            html: true,
            placement: 'top'
          })

          // $('body').on('click', '.clear-input-{{ $model }}', function() {
          //   console.log('limpou input')
          //   $set({{ $model }}, '')
          // })

        })
      </script>
    @endsection

  @endonce
