@extends('layouts.app')

@section('content')

  <div class="h4">
      Relatório de conferência |
    <span class="badge badge-warning">{{ count($pendentes) }} com pendências</span>
    <span class="badge badge-success"> {{ count($conferidos) }} conferidos</span>
    <span class="badge badge-secondary"> {{ count($naoVerificados) }} não verificados</span>
  </div>

  <div class="h3">Pendentes</div>

  <table class="table table-bordered table-sm table-hover datatable">
      <thead>
          <tr>
              <th>Patrimônio</th>
              <th>LocalUSP</th>
              <th>Responsável</th>
              <th>Setor</th>
              <th>Descrição</th>
              <th>Usuário</th>
              <th>Local na sala</th>
          </tr>
      </thead>
    <tbody>
      @foreach ($pendentes as $patrimonio)
        <tr>
          <td>
            <a href="numpat/{{ $patrimonio->numpat }}">{{ formatarNumpat($patrimonio->numpat) }}</a>
          </td>
          <td>
            @if ($patrimonio->codlocusp != $patrimonio->replicado['codlocusp'])
              {{ $patrimonio->replicado['codlocusp'] }} <i class="fas fa-angle-right"></i>
            @endif
            <b>{{ $patrimonio->codlocusp }}</b>
          </td>
          <td>
            @if ($patrimonio->codpes != $patrimonio->replicado['codpes'])
              <span class="text-danger">USP:</span> {{ $patrimonio->replicado['codpes'] }} 
              <i class="fas fa-angle-right"></i>
            @endif
            <b>{{ $patrimonio->codpes }}</b>
          </td>
          <td>
            @if ($patrimonio->setor != $patrimonio->replicado['setor'])
              <span class="text-danger">USP:</span> {{ $patrimonio->replicado['setor'] }} 
              <i class="fas fa-angle-right"></i>
            @endif
            <b>{{ $patrimonio->setor }}</b>
          </td>
          <td>
            {{ $patrimonio->replicado['tipo'] }} | {{ $patrimonio->replicado['nome'] }}
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
