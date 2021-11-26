@extends('layouts.app')

@section('styles')
  @parent
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.css"
    integrity="sha512-AQG3JVpy/h0TsLsFs/HDLjnkq1ih9uUliGGXdQ7LQcGQt7GD+1b7HWOQ2oeCH7tKdtrfRg75CGApafi+//9Dbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

@endsection

@section('content')

  <div class="h4">Buscar por Responsável</div>

  <form id="form-responsavel" action="{{ route('buscarPorResponsavel') }}">
    <x-senhaunica::select-pessoa prepend="Responsável">
      <input type="submit" class="btn btn-sm btn-primary ml-1" value="OK">
    </x-senhaunica::select-pessoa>
  </form>

  <div class="bold">
    {{ $user->codpes }} - {{ $user->name }}
  </div>

  @if ($patrimonios->isNotEmpty())
    <table class="table table-bordered table-hover datatable">
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
  @else

  @endif

@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {
      $('#form-responsavel').submit(function(e) {
        e.preventDefault(e)
        window.location.href = $(this).attr('action') + '/' + $(this).find(':input[name=codpes] option').filter(':selected').val()
        console.log('ok')
      })
    })
  </script>

@endsection
