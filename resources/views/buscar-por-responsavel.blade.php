@extends('layouts.app')

@section('content')

  <div class="h4">Buscar por Responsável</div>

  <form id="form-numpat" action="{{ route('buscarPorResponsavel') }}">
    <x-input-number name="codpes" prepend="Responsável">
      <button id="searchCodpes" class="btn btn-sm btn-primary ml-1">OK</button>
    </x-input-number>
  </form>

  <div class="bold">
    {{ $user->codpes }} - {{ $user->name }}
  </div>

  <table class="table table-bordered table-hover datatable ">
    <thead>
      <tr>
        <th></th>
        <th>Número</th>
        <th>Local</th>
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
          <td>
            <a href="numpat/{{ $patrimonio['numpat'] }}">{{ formatarNumpat($patrimonio['numpat']) }}</a>
          </td>
          <td>{{ $patrimonio->codlocusp }}</td>
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

@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $('#form-numpat').submit(function(e) {
      e.preventDefault(e)
      window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=codpes]').val()
      // console.log(codlocusp)
    })
  </script>

@endsection
