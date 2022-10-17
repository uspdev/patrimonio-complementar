@if ($patrimonio->conferido_em)
  @if ($patrimonio->temPendencias())
    <span class="d-none">1pendente</span>
    <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span>
  @else
    <span class="d-none">2conferido</span>
    <span class="badge badge-success"><i class="fas fa-check"></i></span>
  @endif
@else
  <span class="d-none">0naoVerificado</span>
  <span class="badge badge-secondary"><i class="fas fa-question"></i></span>
@endif
