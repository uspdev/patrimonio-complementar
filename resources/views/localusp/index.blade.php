@extends('layouts.app')

@section('content')

  <div class="h4">
    Locais
    <span class="badge badge-primary">{{ implode(',', $setores) }}</span>
  </div>

  @if (count($localusps))
    <div class="ml-3">
      Os locais não são associados a setor na base replicada. Se um local não aparecer aqui solicite sua inclusão ao
      resposável desse sistema.
    </div>

    <div class="mt-3">
      <table class="table table-bordered table-hover datatable">
        <thead>
          <tr>
            <th>Setor</th>
            <th>Número</th>
            <th>Andar</th>
            <th>Nome</th>
            <th>Replicação (tipo|estilo?|bloco)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($localusps as $localusp)
            <tr>
              <td>{{ $localusp->setor }}</td>
              <td>
                <a href="{{ route('buscarPorLocal') }}/{{ $localusp->codlocusp }}">{{ $localusp->codlocusp }}</a>
              </td>
              <td>@include('localusp.partials.andar')</td>
              <td>@include('localusp.partials.nome')</td>
              <td>
                {{ $localusp->replicado['tiplocusp'] ?? '-' }}
                | {{ $localusp->replicado['stiloc'] ?? '-' }}
                | {{ $localusp->replicado['idfblc'] ?? '-' }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    Não foram encontrados locais associados aos setores acima.
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
