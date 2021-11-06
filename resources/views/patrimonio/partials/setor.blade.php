@if ($patrimonio->setor && $bem['setor'] != $patrimonio->setor)
  {{ $patrimonio->setor }}
  (<span class="text-danger">USP: {{ $bem['setor'] }}</span>)
@else
  {{ $bem['setor'] }}
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif