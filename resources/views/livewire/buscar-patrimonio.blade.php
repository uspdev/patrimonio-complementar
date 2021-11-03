<div class="d-block">
  <form class="" wire:submit.prevent="atualizarNumpat">
    <x-wire-input-text model="numpat" prepend="<i class='fas fa-landmark'></i>">
      <button class="btn btn-primary ml-1" wire.click="updatedNumpat">OK</button>
    </x-wire-input-text>
  </form>
  <div class="mt-3">
    @if ($bem)
    
      @if ($bem['stabem'] != 'Ativo')
        <div class="text-danger">Estado: {{ $bem['stabem'] }}</div>
      @endif
      <div>
        Nro: <b>{{ formatarNumpat($bem['numpat']) }}</b><br>
        {{ $bem['tipo'] }} | {{ $bem['nome'] }}<br>
        Desc: {{ $bem['descricao'] }}<br>
        Setor/bloco: <b>{{ $bem['setor'] }}</b> | {{ $bem['piso'] }}<br>
        Local: <b>{{ $bem['localusp'] }}</b> {{ $bem['sala'] }}<br>
        Resp: <b>{{ $bem['nompes'] }}</b> - {{ $bem['codpes'] }} <br>
      </div>

      @if ($bem['stabem'] == 'Ativo')
        <div class="mt-3">
          <button class="btn btn-primary">Confirmar</button>
          <button class="btn btn-warning">Alterar</button>
        </div>
      @endif

    @else
      <div class="text-danger">
        Patrimônio {{ formatarNumpat($numpat) }} não encontrado!
      </div>
    @endif
  </div>
</div>
