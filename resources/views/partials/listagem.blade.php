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
        <td data-order="{{ $patrimonio->codlocusp }}">
          {{ $patrimonio->codlocusp }} - {{ $patrimonio->localusp()->nome ?? '' }}
          ({{ $patrimonio->localusp()->setor ?? '' }})
        </td>
        <td>
          {{ $patrimonio->codpes }} - {{ $patrimonio->obterNomeCodpes() }}
        </td>
        <td>
          {{ $patrimonio->usuario }}
        </td>
        <td>
          {{ $patrimonio->local }}
        </td>
        <td>
            {{  $patrimonio->obs }}
        </td>
        <td>
          ({{ $patrimonio->replicado['sglcendsp'] ?? '' }})
          {{ $patrimonio->replicado['tipo'] }}
          ; {{ $patrimonio->replicado['nome'] }}
          ; {{ $patrimonio->replicado['descricao'] }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
