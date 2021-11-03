@php $prev['localusp'] = 0 @endphp
@foreach ($data as $row)
  @if ($prev['localusp'] != $row['localusp'])
    <div class="page-break"></div>
    <b>{{ $row['setor'] }} | piso {{ $row['piso'] }} | sala {{ $row['localusp'] }} - {{ $row['sala'] }}</b> <br>
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
