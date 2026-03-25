{{-- @isset($this)
    <span class="text-danger">Componente: {{ get_class($this) }}</span>
    {{ $patrimonio }}
    {{ $setor }}<br>
    {{ $numpat }}<br>
  @endisset --}}

<form wire:submit="salvar">
  <div class="mb-2">
    <div class="h5">Editando ..</div>
    <x-wire-input-text model="setor" prepend="Setor"></x-wire-input-text>
    <x-wire-input-number model="codlocusp" prepend="Local USP"></x-wire-input-number>
    <x-wire-input-number model="codpes" prepend="Resp"></x-wire-input-number>
    <x-wire-input-text model="usuario" prepend="Usuário"></x-wire-input-text>
    <x-wire-input-text model="local" prepend="Local na sala"></x-wire-input-text>
    <x-wire-input-textarea model="obs" prepend="Observações"></x-wire-input-textarea>
  </div>
  <button class="btn btn-small btn-primary">OK</button>
  <button type="button" class="btn btn-small btn-warning" wire:click="cancelar">Cancelar</button>
</form>
