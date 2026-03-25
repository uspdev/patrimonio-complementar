<div>
  <div class="row d-block">
    <div class="col-md-6">
      <form wire:submit="buscar">
        <x-wire-input-text model="numpat" prepend="<i class='fas fa-landmark'></i>">
          <button class="btn btn-primary ml-1">OK</button>
        </x-wire-input-text>
      </form>
    </div>

  </div>
  {{-- {{ $numpat }} --}}
  <div wire:key="patrimonio-wrapper">
    @if ($bem)
      @include('livewire.partials.patrimonio-detalhes')
    @else
      @include('livewire.partials.patrimonio-nao-encontrado')
    @endif
  </div>

  @section('javascripts_bottom')
    @parent
    <script>
      // Atualiza a url ao mudar o numpat
      // https://stackoverflow.com/questions/4475367/how-to-change-url-at-address-bar-without-reloading-the-page
      window.addEventListener('update-url', event => {
        window.history.pushState('', '', event.detail.url)
      })
    </script>
  @endsection
</div>
