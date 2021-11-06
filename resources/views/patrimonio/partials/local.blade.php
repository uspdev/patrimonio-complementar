@if ($patrimonio->codlocusp && $bem['codlocusp'] != $patrimonio->codlocusp)
  {{ $patrimonio->codlocusp }}
  (<span class="text-danger">USP: {{ $bem['codlocusp'] }}</span>)
@else
  {{ $bem['codlocusp'] }}
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif