@if ($editar)
  <div class="mb-2">
    Editando ..<br>
    <x-wire-input-text model="patrimonio.setor" prepend="Setor">
      </x-input-text>
      <x-wire-input-number model="patrimonio.codlocusp" prepend="Local">
        </x-input-text>
        <x-wire-input-number model="patrimonio.codpes" prepend="Resp">
          </x-input-text>
  </div>
  <button class="btn btn-small btn-primary" wire:click="confirmar">OK</button>
  <button class="btn btn-small btn-warning" wire:click="$set('editar', false)">Cancelar</button>
@endif
