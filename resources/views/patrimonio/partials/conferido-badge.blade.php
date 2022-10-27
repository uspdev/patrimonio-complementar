<div class="mb-2">
  @if ($patrimonio->conferido_em)
    <button href="#conferido-em-details" class="badge badge-success" data-toggle="collapse">
      <i class="fas fa-check mr-2"></i>
      Conferido {{ dias($patrimonio->conferido_em) }}
      <i class="fas fa-caret-down ml-2"></i>
    </button>
    <div href="#conferido-em-details" class="collapse alert alert-info" id="conferido-em-details" data-toggle="collapse">

      em: {{ $patrimonio->conferido_em->format('d/m/Y H:i') }}<br>
      // tem de criar uma lógica melhor sobre quem conferiu
      por: {{ $patrimonio->user->name }} <br>

      @if ($patrimonio->conferido_em->diff(now())->days > 10)
        <button class="btn btn-sm btn-primary" wire:click="confirmar">
          <i class="fas fa-check-circle"></i> Confirmar novamente
        </button>
      @endif

    </div>
  @endif

  @if ($patrimonio->replicado['stabem'] != 'Ativo')
    <span class="badge badge-danger">{{ $patrimonio->replicado['stabem'] }}</span>
  @else
    @if ($patrimonio->temPendencias())
      <span class="badge badge-warning">Com pendências</span>
    @endif
  @endif

</div>
