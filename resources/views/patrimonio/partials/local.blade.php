({{ $localusp->setor }})

@if (Gate::check('manager'))
  <a href="buscarPorLocal/{{ $patrimonio->codlocusp }}">{{ $patrimonio->codlocusp }} <i class="fas fa-share"></i></a>
@else
  {{ $patrimonio->codlocusp }}
@endif

- {{ $localusp->nome }}

{{-- se local difere do replicado vamos acrescentar dados --}}
@if ($bem['codlocusp'] != $patrimonio->codlocusp)
  <span class="badge badge-warning">USP:
    @if (Gate::check('manager'))
      <a href="buscarPorLocal/{{ $bem['codlocusp'] }}">{{ $bem['codlocusp'] }} <i class="fas fa-share"></i></a>
    @else
      {{ $bem['codlocusp'] }}
    @endif
  </span>
@else
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
