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
    @if ($bem)

      @include('patrimonio.partials.conferido-badge')

      @if ($bem['stabem'] != 'Ativo')
        <div class="text-danger">Estado: {{ $bem['stabem'] }}</div>
      @endif
      <div>
        Nro: <b>{{ formatarNumpat($bem['numpat']) }}</b><br>
        {{ $bem['tipo'] }} | {{ $bem['nome'] }}<br>
        Desc: {{ $bem['descricao'] }}<br>
        Setor/bloco: @include('patrimonio.partials.setor')<br>
        Local: @include('patrimonio.partials.local')<br>
        Resp: @include('patrimonio.partials.responsavel') <br>
      </div>
      @include('patrimonio.partials.editar-form')

      @if ($bem['stabem'] == 'Ativo')
        <div class="mt-3">
          @include('patrimonio.partials.conferir-button')

          <div class="float-right">
            <button class="btn btn-warning" wire:click="$set('editar', true)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-secondary" wire:click="buscar"><i class="fas fa-redo"></i></button>
          </div>
        </div>
      @endif

    @else
      <div class="text-danger">
        @if (empty($numpat))
          Informe um número de patrimônio.
        @else
          Patrimônio {{ formatarNumpat($numpat) }} não encontrado!
        @endif
      </div>
    @endif
  </div>
</div>
