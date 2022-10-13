@extends('layouts.app')

@section('content')
  <div class="h3">
    Lista por LocalUSP <span class="badge badge-primary">{{ implode(',', $setores) }}</span>
    @if (count($localusps))
      | <a href="listarPorSala?pdf=1">Baixar pdf</a>
    @endif
    <hr />
  </div>

  @if (count($localusps))
    @include('patrimonio.partials.lista-por-sala')
  @else
    Não foram encontrados locais associados aos setores acima.
  @endif
@endsection
