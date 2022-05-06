<div>
  <div class="d-block">

    <form wire:submit.prevent="buscar">
      <x-wire-input-number model="numpat" prepend="<i class='fas fa-landmark'></i>">
        <button class="btn btn-primary ml-1">OK</button>
      </x-wire-input-number>
    </form>
  </div>
  {{-- {{ $numpat }} --}}
  <div>
    @includeWhen($bem, 'livewire.partials.patrimonio-detalhes')
    @includeUnless($bem, 'livewire.partials.patrimonio-nao-encontrado')
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
