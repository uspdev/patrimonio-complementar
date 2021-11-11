@extends('layouts.app')

@section('content')

  <div class="mb-3">
    <form id="form-localusp" method="GET" action="">
      Numero da sala
      <input type="number" name="codlocusp" />
      <button class="btn btn-sm btn-primary" type="submit">OK</button>
    </form>
  </div>

  <div class="mb-3">
    Total: {{ count($patrimonios) }}<br />
    @if (count($patrimonios))
      LocalUSP: {{ $codlocusp }}
    @endif
  </div>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Número</th>
        <th>Responsável</th>
        <th>Tipo/Descrição</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($patrimonios as $patrimonio)
        <tr>
          <td>
            @if ($patrimonio->conferido_em)
              @if ($patrimonio->temPendencias($patrimonio->replicado))
                <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i></span>
              @else
                <span class="badge badge-success"><i class="fas fa-check"></i></span>
              @endif
            @else
              <span class="badge badge-secondary"><i class="fas fa-question"></i></span>
            @endif
          </td>
          <td><a href="numpat/{{ $patrimonio['numpat'] }}">{{ formatarNumpat($patrimonio['numpat']) }}</a></td>
          <td>{{ $patrimonio->replicado['responsavel'] }}</td>
          <td>{{ $patrimonio->replicado['tipo'] }}; {{ $patrimonio->replicado['nome'] }};
            {{ $patrimonio->replicado['descricao'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {
      $('#form-localusp').submit(function(e) {
        e.preventDefault(e)
        window.location.href = 'localusp/' + $(this).find('input').val()
        // console.log(codlocusp)
      })
    })
  </script>

@endsection
