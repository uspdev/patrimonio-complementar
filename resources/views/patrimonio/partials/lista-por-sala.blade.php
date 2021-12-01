@foreach ($localusps as $localusp)
  <b>{{ $localusp->setor }}</b> | piso <b>{{ $localusp->andar }}</b> | sala <b>{{ $localusp->codlocusp }} -
    {{ $localusp->nome }}</b> | quant. <b>{{ $localusp->contarPatrimonios() }}</b> itens<br>
  <br>
  @foreach ($localusp->patrimonios() as $patrimonio)
    {{ formatarNumpat($patrimonio->numpat) }} | bem: {{ mb_strtolower($patrimonio->replicado['tipo']) }} /
    {{ mb_strtolower($patrimonio->replicado['nome']) }} | descr.: {{ $patrimonio->replicado['descricao'] }} <br>
    {{ $patrimonio->replicado['codpes'] }} - {{ $patrimonio->replicado['nompes'] }} <br>
    <br>
  @endforeach
  <div class="page-break"></div> {{-- para quegrar página no PDF --}}

@endforeach
