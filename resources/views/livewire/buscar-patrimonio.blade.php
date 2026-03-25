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
  <div wire:key="patrimonio-wrapper">
    @if ($bem)
      @include('livewire.partials.patrimonio-detalhes')
    @else
      @include('livewire.partials.patrimonio-nao-encontrado')
    @endif
  </div>

  @push('scripts')
    <script>
      window.addEventListener('update-url', event => {
        window.history.pushState('', '', event.detail.url)
      })
    </script>
  @endpush
</div>
