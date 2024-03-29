@include('patrimonio.partials.conferido-badge')

<div>
  Nro: <b>{{ formatarNumpat($bem['numpat']) }}</b><br>

  @if (!$editar)
    <div class="row">
      <div class="col-md-6">
        {{ $bem['tipo'] }} | {{ $bem['material'] }}<br>
        Desc: {{ $bem['descricao'] }}<br>
        Setor/bloco: <b>@include('patrimonio.partials.setor')</b><br>
        Local: @include('patrimonio.partials.local')<br>
        Resp: @include('patrimonio.partials.responsavel') <br>
      </div>
      <div class="col-md-6">
        <div class="mb-2"></div>
        Usuário: <b>{{ $patrimonio->usuario }}</b> <br>
        Local na sala: <b>{{ $patrimonio->local }}</b><br>
        Observações: <br>
        <div class="ml-2 font-weight-bold">
          {!! nl2br($patrimonio->obs) !!}
        </div>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif
  @endif


  @can('patrimonios.update', $patrimonio)
    @include('patrimonio.partials.editar-form')

    @if ($bem['stabem'] == 'Ativo' && $editar == false)
      <div class="row mt-3">
        <div class="col-md-6">
          @include('patrimonio.partials.conferir-button')

          {{-- Somente admin por enquanto --}}
          {{-- @includeWhen(Gate::check('admin'), 'patrimonio.partials.abrir-mercurio-button', [
              'numpat' => $bem['numpat'],
          ]) --}}

          {{-- <button class="btn btn-success">Dados USP estão corretos <i class="fas fa-download"></i></button> --}}

          <div class="float-right">
            <button class="btn btn-success" wire:click="$set('editar', true)">Editar <i class="fas fa-edit"></i></button>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    @endif
  @endcan

  <hr />
  <div class="row">
    <div class="col-md-12">

      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-dadosusp-tab" data-toggle="tab" data-target="#nav-dadosusp"
            type="button" role="tab">Dados USP</button>
          <button class="nav-link" id="nav-registro-tab" data-toggle="tab" data-target="#nav-registro" type="button"
            role="tab">Log</button>
          {{-- <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button"
            role="tab">Contact</button> --}}
        </div>
      </nav>

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-dadosusp" role="tabpanel">
          <div class="mb-3"></div>
          @include('patrimonio.partials.dados-usp')
        </div>
        <div class="tab-pane fade" id="nav-registro" role="tabpanel">
          <div class="mb-3"></div>
          @include('patrimonio.partials.audit')
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel">teste</div>
      </div>
    </div>

  </div>
