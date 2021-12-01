@extends('layouts.app')

@section('content')

  <div class="mb-3">
    <form id="form-localusp" method="GET" action="{{ route('buscarPorLocal') }}">
      Numero da sala
      <input type="number" name="codlocusp" />
      <button class="btn btn-sm btn-primary" type="submit">OK</button>
    </form>
  </div>

  @if (count($patrimonios))
    <div class="h4 mb-3">
      Local {{ $localusp->codlocusp }} - {{ $localusp->nome }}
      <span class="badge badge-primary">{{ count($patrimonios) }} registros</span>
    </div>

    <table class="table table-bordered table-hover datatable ">
      <thead>
        <tr>
          <th></th>
          <th>Número</th>
          <th>Responsável</th>
          <th>Tipo/Descrição</th>
          <th>Usuário</th>
          <th>Local na sala</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($patrimonios as $patrimonio)
          <tr>
            <td>
              @if ($patrimonio->conferido_em)
                @if ($patrimonio->temPendencias())
                  <span class="d-none">1pendente</span>
                  <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span>
                @else
                  <span class="d-none">2conferido</span>
                  <span class="badge badge-success"><i class="fas fa-check"></i></span>
                @endif
              @else
                <span class="d-none">0naoVerificado</span>
                <span class="badge badge-secondary"><i class="fas fa-question"></i></span>
              @endif
            </td>
            <td><a href="numpat/{{ $patrimonio['numpat'] }}">{{ formatarNumpat($patrimonio['numpat']) }}</a></td>
            <td>{{ $patrimonio->replicado['codpes'] }} - {{ $patrimonio->replicado['nompes'] }}</td>
            <td>
              {{ $patrimonio->replicado['tipo'] }}; {{ $patrimonio->replicado['nome'] }};
              {{ $patrimonio->replicado['descricao'] }}
            </td>
            <td>
              {{ $patrimonio->usuario }}
            </td>
            <td>
              {{ $patrimonio->local }}
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
        window.location.href = $(this).attr('action')+ '/' + $(this).find('input').val()
      })
    })
  </script>

@endsection
