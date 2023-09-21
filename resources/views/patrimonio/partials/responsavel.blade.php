@if ($bem['codpes'] != $patrimonio->codpes)

  {{ $patrimonio->nompes }} - {{ $patrimonio->codpes }}
  <span class="badge badge-warning">USP: <b>{{ $bem['nompes'] }}</b> - {{ $bem['codpes'] }}</span>
@else
  <b>{{ $bem['nompes'] }}</b> -

  @if (Gate::check('manager'))
    {{-- com link para listar por responsavel --}}
    <a href="{{ route('buscarPorResponsavel') }}/{{ $patrimonio->codpes }}">{{ $bem['codpes'] }} <i
        class="fas fa-share"></i></a>
  @else
    {{ $patrimonio->codpes }}
  @endif

  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
