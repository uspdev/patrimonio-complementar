<a href="buscarPorLocal/{{ $patrimonio->codlocusp }}">
  {{ $patrimonio->codlocusp }} <i class="fas fa-share"></i>
</a>
- {{ $localusp->nome }}

@if ($bem['codlocusp'] != $patrimonio->codlocusp)
  (
  <span class="text-danger">USP: </span>
  <a href="buscarPorLocal/{{ $bem['codlocusp'] }}">{{ $bem['codlocusp'] }} <i class="fas fa-share"></i></a>
  )
@else
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
