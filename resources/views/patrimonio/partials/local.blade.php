@if ($patrimonio->codlocusp && $bem['codlocusp'] != $patrimonio->codlocusp)
  {{ $patrimonio->codlocusp }}
  <a href="localusp/{{ $patrimonio->codlocusp }}">Ir <i class="fas fa-share"></i></a>
  (
    <span class="text-danger">USP: {{ $bem['codlocusp'] }}</span>
    <a href="localusp/{{ $bem['codlocusp'] }}">Ir <i class="fas fa-share"></i></a>
  )
@else
  {{ $bem['codlocusp'] }}
  <a href="localusp/{{ $bem['codlocusp'] }}">Ir <i class="fas fa-share"></i></a>

  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
