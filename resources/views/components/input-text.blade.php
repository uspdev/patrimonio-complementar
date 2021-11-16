@props([
    'model' => '',
    'prepend' => '',
    'append' => '',
    'label' => '',
    'class' => '',
    'id' => 'input-text-' . mt_rand(1000000, 9999999),
])

<div class="form-group {{ $class }} wire-input-text">
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <input id="{{ $id }}" class="form-control" type="text"
      {{ $attributes }}
    />
    {{ $slot }}
    @if ($append)
      <div class="input-group-append">
        <div class="input-group-text">{!! $append !!}</div>
      </div>
    @endif
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
        //   $('.wire-input-text').find('input').popover({
        //     html: true,
        //     placement: 'top'
        //   })

          $('body').on('click', '.clear-input', function() {
            console.log('limpou input')
            $(this).parent().find('input').val('')
          })

        })
      </script>
    @endsection

  @endonce
