@extends('layouts.app')

@section('content')


  @if (count($localusps))
    <div class="h4 mb-3">
      Locais
    </div>

    <table class="table table-bordered table-hover datatable ">
      <thead>
        <tr>
          <th>Setor</th>
          <th>Número</th>
          <th>Andar</th>
          <th>Nome</th>
          <th>Replicação</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($localusps as $localusp)
          <tr>
            <td>{{ $localusp->setor }}</td>
            <td>
              <a href="{{ route('buscarPorLocal') }}/{{ $localusp->codlocusp }}">{{ $localusp->codlocusp }}</a>
            </td>
            <td>{{ $localusp->andar }} (USP: {{ $localusp->replicado['idfadr'] ?? ''}})</td>
            <td>{{ $localusp->nome }} (USP: {{ $localusp->replicado['idfloc'] }})</td>
            <td>
              {{ $localusp->replicado['tiplocusp'] ?? '-' }}
              | {{ $localusp->replicado['stiloc'] ?? '-' }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @else
    @if ($localusp->codlocusp)
      Não foram encontrados registros na sala {{ $localusp->codlocusp }}
    @endif
  @endif


@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {

      // troca o envio do form por link com o nro da sala
      $('#form-localusp').submit(function(e) {
        e.preventDefault(e)
        window.location.href = 'localusp/' + $(this).find('input').val()
      })
    })
  </script>

@endsection
