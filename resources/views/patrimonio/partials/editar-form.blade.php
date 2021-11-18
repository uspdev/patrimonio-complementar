@if ($editar)
  <form wire:submit.prevent="confirmar">
    <div class="mb-2">
      <div class="h5">Editando ..</div>
      <x-wire-input-text model="patrimonio.setor" prepend="Setor">
        </x-input-text>
        <x-wire-input-number model="patrimonio.codlocusp" prepend="Local USP">
          </x-input-text>
          <x-wire-input-number model="patrimonio.codpes" prepend="Resp">
            </x-input-text>
            <x-wire-input-text model="patrimonio.usuario" prepend="Usuário"></x-wire-input-text>
            <x-wire-input-text model="patrimonio.local" prepend="Local na sala"></x-wire-input-text>
    </div>
    <button class="btn btn-small btn-primary">OK</button>
    <button class="btn btn-small btn-warning" wire:click="cancelar">Cancelar</button>
  </form>

@endif
