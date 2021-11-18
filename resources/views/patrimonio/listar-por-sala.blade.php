@extends('layouts.app')

@section('content')
  <div class="h3">
    <a href="listarPorSala?pdf=1">Baixar pdf</a> |
    Total: {{ count($data) }}
    <hr />
  </div>
  @include('patrimonio.partials.lista-por-sala')
@endsection
