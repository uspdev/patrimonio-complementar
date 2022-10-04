@if ($patrimonio->mostrarBotaoConfirmar())
  <button class="btn btn-primary" wire:click="confirmar">
    <i class="fas fa-check-circle"></i> Confirmar
  </button>
@endif

@if ($patrimonio->mostrarBotaoConfirmarUndo())
  <button class="btn btn-warning" wire:click="confirmarUndo">
    <i class="fas fa-undo"></i> Desf. confirmar
    {{-- <span class="countdown"></span> --}}
  </button>
@endif

{{-- @section('javascripts_bottom')
  @parent
  <script>
    $(function() {
      var counter = 10;
      var interval = setInterval(function() {
        counter--;
        $('.countdown').html(interval)
        console.log(counter)
        // Display 'counter' wherever you want to display it.
        if (counter == 0) {
          // Display a login box
          clearInterval(interval);
        }
      }, 1000);
    })
  </script>
@endsection --}}
