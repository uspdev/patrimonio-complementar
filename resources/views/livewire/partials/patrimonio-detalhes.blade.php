@include('patrimonio.partials.conferido-badge')

<div>
  @if ($bem['stabem'] != 'Ativo')
    <div class="text-danger">Estado: {{ $bem['stabem'] }}</div>
  @endif
  Nro: <b>{{ formatarNumpat($bem['numpat']) }}</b><br>

  @if (!$editar)
    {{ $bem['tipo'] }} | {{ $bem['nome'] }}<br>
    Desc: {{ $bem['descricao'] }}<br>
    Setor/bloco: @include('patrimonio.partials.setor')<br>
    Local: @include('patrimonio.partials.local')<br>
    Resp: @include('patrimonio.partials.responsavel') <br>
    <div class="mb-2"></div>
    Usuário: <b>{{ $patrimonio->usuario }}</b> <br>
    Local na sala: <b>{{ $patrimonio->local }}</b>
    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif
  @endif

  {{-- </div> --}}

  @can('gerente')
    @include('patrimonio.partials.editar-form')

    @if ($bem['stabem'] == 'Ativo' && $editar == false)
      <div class="mt-3">
        @include('patrimonio.partials.conferir-button')

        {{-- Somente admin por enquanto --}}
        @includeWhen(Gate::check('admin'), 'patrimonio.partials.abrir-mercurio-button', [
            'numpat' => $bem['numpat'],
        ])

        {{-- <button class="btn btn-success">Dados USP estão corretos <i class="fas fa-download"></i></button> --}}

        <div class="float-right">
          <button class="btn btn-primary" wire:click="$set('editar', true)"><i class="fas fa-edit"></i></button>
        </div>
        <div class="clearfix"></div>
      </div>
    @endif
  @endcan

  <hr />
  <div class="row">
    <div class="col-md-4">
      @include('patrimonio.partials.dados-usp')
    </div>
    <div class="col-md-8">
      @includeWhen(Gate::check('gerente'), 'patrimonio.partials.audit')
    </div>
  </div>

</div>
