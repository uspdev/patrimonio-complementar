@if ($patrimonio->conferido_em)
  @if ($patrimonio->temPendencias())
    <span class="d-none">1pendente</span>
    <span class="badge badge-danger" title="Com pendências">
      <i class="fas fa-exclamation-triangle"></i> {{ $patrimonio->conferido_em->diffInDays(now()) }}
    </span>
  @else
    <span class="d-none">2conferido</span>
    @if ($patrimonio->conferido_em->diffInDays(now()) > 90)
      <span class="badge badge-warning" title="Verificado há mais de 90 dias">
        <i class="fas fa-exclamation"></i> {{ $patrimonio->conferido_em->diffInDays(now()) }}
      </span>
    @else
      <span class="badge badge-success" title="Verificado há menos de 90 dias">
        <i class="fas fa-check"></i> {{ $patrimonio->conferido_em->diffInDays(now()) }}
      </span>
    @endif
  @endif
@else
  <span class="d-none">0naoVerificado</span>
  <span class="badge badge-secondary" title="Não verificado">
    <i class="fas fa-question"></i>
  </span>
@endif
