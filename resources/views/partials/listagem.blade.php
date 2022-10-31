<table class="table table-bordered table-hover datatable ">
  <thead>
    <tr>
      <th></th>
      <th>Número</th>
      <th>Local</th>
      <th>Responsável</th>
      <th>Usuário</th>
      <th>Local na sala</th>
      <th>Observações</th>
      <th>(Cendsp) Tipo/Nome/Descrição</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($patrimonios as $patrimonio)
      <tr>
        <td>@include('partials.badge-status')</td>
        <td>
          <a href="numpat/{{ $patrimonio['numpat'] }}">{{ formatarNumpat($patrimonio['numpat']) }}</a>
        </td>
        <td data-order="{{ $patrimonio->codlocusp }}">
          {{ $patrimonio->codlocusp }} - {{ $patrimonio->localusp()->nome ?? '' }}
          ({{ $patrimonio->localusp()->setor ?? '' }})
          @if ($patrimonio->codlocusp != $patrimonio->replicado['codlocusp'])
            <span class="badge badge-warning">USP: {{ $patrimonio->replicado['codlocusp'] }}</span>
          @endif
        </td>
        <td>
          {{ $patrimonio->codpes }} - {{ $patrimonio->obterNomeCodpes() }}
          @if ($patrimonio->codpes != $patrimonio->replicado['codpes'])
            <span class="badge badge-warning">USP: {{ $patrimonio->replicado['codpes'] }}</span>
          @endif
        </td>
        <td>{{ $patrimonio->usuario }}</td>
        <td>{{ $patrimonio->local }}</td>
        <td>{{ $patrimonio->obs }}</td>
        <td>
          ({{ $patrimonio->replicado['sglcendsp'] ?? '' }})
          {{ $patrimonio->replicado['tipo'] }}
          ; {{ $patrimonio->replicado['material'] ?? '' }}
          ; {{ $patrimonio->replicado['descricao'] }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
