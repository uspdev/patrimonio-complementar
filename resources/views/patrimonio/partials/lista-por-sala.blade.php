@foreach ($localusps as $localusp)
  <b>{{ $localusp->setor }}</b> | piso <b>{{ $localusp->andar }}</b> | sala <b>{{ $localusp->codlocusp }} -
    {{ $localusp->nome }}</b> | quant. <b>{{ $localusp->contarPatrimonios() }}</b> itens<br>
  <br>

  @foreach ($localusp->patrimonios() as $patrimonio)
    @if ($view == 'pdf')
      {{ formatarNumpat($patrimonio->numpat) }}
    @else
      <a href="{{ route('buscarPorNumpat', $patrimonio->numpat) }}">{{ formatarNumpat($patrimonio->numpat) }}</a>
    @endif
    | bem: {{ mb_strtolower($patrimonio->replicado['tipo']) }} /
    {{ mb_strtolower($patrimonio->replicado['material'] ?? '') }} | descr.: {{ $patrimonio->replicado['descricao'] }}
    | <i class="fas fa-user"></i> {{ $patrimonio->replicado['tiputl'] == 'I' ? 'individual' : 'coletivo' }} >
    {{ $patrimonio->usuario }}
    @if ($patrimonio->local)
      ; <i class="fas fa-map-marker-alt"></i> {{ $patrimonio->local }}
    @endif
    <br>
    {{ $patrimonio->replicado['codpes'] }} - {{ $patrimonio->replicado['nompes'] }} <br>
    <br>
  @endforeach

  <div class="page-break"></div> {{-- para quegrar página no PDF --}}
@endforeach
