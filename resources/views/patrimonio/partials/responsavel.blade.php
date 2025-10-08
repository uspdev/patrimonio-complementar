@if ($bem['codpes'] != $patrimonio->codpes)
  {{-- Quando o responsável do bem e do patrimônio são diferentes --}}
  {{ $patrimonio->nompes }} - {{ $patrimonio->codpes }}
  <span class="badge badge-warning">
    USP: <b>{{ $bem['nompes'] }}</b> - {{ $bem['codpes'] }}
  </span>
@else
  {{-- Quando o responsável é o mesmo --}}
  <b>{{ $bem['nompes'] }}</b> -

  @can('manager')
    <a href="{{ route('buscarPorResponsavel', $patrimonio->codpes) }}">
      {{ $bem['codpes'] }} <i class="fas fa-share"></i>
    </a>
  @else
    {{ $patrimonio->codpes }}
  @endcan

  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success" title="Conferido em {{ $patrimonio->conferido_em->format('d/m/Y') }}"></i>
  @endif
@endif
