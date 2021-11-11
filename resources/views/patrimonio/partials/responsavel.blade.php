
@if ($bem['codpes'] != $patrimonio->codpes)
  {{ $patrimonio->codpes }} 
  (<span class="text-danger">USP: <b>{{ $bem['nompes'] }}</b> - {{ $bem['codpes'] }}</span>)
@else
  <b>{{ $bem['nompes'] }}</b> - {{ $bem['codpes'] }}
  @if ($patrimonio->conferido_em)
    <i class="fas fa-check text-success"></i>
  @endif
@endif
