@if ($patrimonio->setor && $bem['sglcendsp'] != $patrimonio->setor)
  {{ $patrimonio->setor }}
  (<span class="badge badge-warning">USP: {{ $bem['sglcendsp'] }}</span>)
@else
  {{ $bem['sglcendsp'] }}
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
