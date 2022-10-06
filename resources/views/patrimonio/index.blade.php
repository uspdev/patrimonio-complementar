@extends('layouts.app')

@section('content')

  @can('gerente')
    <div class="card h4 text-warning">
      <div class="card-header">
        Buscar por
      </div>
      <div class="card-body">
        {{-- <div class="h4"></div> --}}

        <form id="form-numpat" action="{{ route('buscarPorNumpat') }}">
          <x-input-text name="numpat" prepend="Patrimônio">
            <button id="searchNumpat" class="btn btn-sm btn-primary ml-1">OK</button>
          </x-input-text>
        </form>

        <form id="form-localusp" action="{{ route('buscarPorLocal') }}">
          <x-input-number name="codlocusp" prepend="Local">
            <button id="searchCodlocusp" class="btn btn-sm btn-primary ml-1">OK</button>
          </x-input-number>
        </form>
      </div>
    </div>
  @endcan

  <br>
  <div class="h4">
    Meus Patrimônios
  </div>

  @if ($patrimonios->isNotEmpty())
    <table class="table table-bordered table-hover datatable">
      <thead>
        <tr>
          <th></th>
          <th>Número</th>
          <th>Local</th>
          <th>Local na sala</th>
          <th>Usuário</th>
          <th>Observações</th>
          <th>Tipo/Nome/Descrição</th>
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
              {{-- {{ $patrimonio->replicado['stabem'] }} --}}
            </td>
            <td>{{ $patrimonio->codlocusp }} - {{ $patrimonio->localusp()->nome ?? '' }} ({{ $patrimonio->localusp()->setor ?? '' }})</td>
            <td>
              {{ $patrimonio->local }}
            </td>
            <td>
              {{ $patrimonio->usuario }}
            </td>
            <td>
              {{ $patrimonio->obs }}
            </td>
            <td>
              {{ $patrimonio->replicado['tipo'] }}; {{ $patrimonio->replicado['nome'] }};
              {{ $patrimonio->replicado['descricao'] }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
  @endif


@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $('#form-localusp').submit(function(e) {
      e.preventDefault(e)
      window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=codlocusp]').val()
      // console.log(codlocusp)
    })

    $('#form-numpat').submit(function(e) {
      e.preventDefault(e)
      window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=numpat]').val()
      // console.log(codlocusp)
    })
  </script>
@endsection
