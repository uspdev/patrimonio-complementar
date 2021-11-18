@php $prev['codlocusp'] = 0 @endphp
@foreach ($data as $row)
  @if ($prev['codlocusp'] != $row['codlocusp'])
    <div class="page-break"></div> {{-- para quegrar página no PDF --}}
    <b>{{ $row['setor'] }} | piso {{ $row['piso'] }} | sala {{ $row['codlocusp'] }} - {{ $row['sala'] }}</b> <br>
    <br>
  @endif
  {{-- <div> --}}
    {{ formatarNumpat($row['numpat']) }} | bem: {{ mb_strtolower($row['tipo']) }} /
    {{ mb_strtolower($row['nome']) }} | descr.: {{ $row['descricao'] }} <br>
    {{ $row['responsavel'] }} <br>
    <br>
  {{-- </div> --}}
  @php $prev = $row; @endphp
@endforeach
