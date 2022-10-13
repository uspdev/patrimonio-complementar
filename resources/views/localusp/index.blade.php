@extends('layouts.app')

@section('content')

  <div class="h4">
    Locais <span class="badge badge-success">{{ count($localusps) }}</span>
    <span class="badge badge-primary">{{ implode(',', $setores) }}</span>
    <a href="{{ route('localusp.admin') }}?sync=true" class="btn btn-sm btn-outline-secondary">Sincronizar com replicado</a>
  </div>

  @if (count($localusps))
    <div class="ml-3">
      Os locais não são associados a setor na base replicada. Se um local não aparecer aqui solicite sua inclusão ao
      resposável desse sistema.
    </div>

    <div class="mt-3">
      <table class="table table-bordered table-hover localusp">
        <thead>
          <tr>
            <th></th>
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
              <td>
                @include('localusp.partials.modal-editar')
              </td>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css">
  <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
  <script>
    $(document).ready(function() {

      oTable = $('.localusp').DataTable({
        dom: 't',
        "paging": false,
        "sort": true,
        "order": [
          [1, "asc"]
        ],
        "fixedHeader": true,
        columnDefs: [{
          targets: 0,
          orderable: false
        }],
      });
    })
  </script>
@endsection
