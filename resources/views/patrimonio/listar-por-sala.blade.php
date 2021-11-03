@extends('layouts.app')

@section('content')
  <div class="h3">
    <a href="?pdf=1">Baixar pdf</a> |
    Total: {{ count($data) }}
    <hr />
  </div>
  @include('patrimonio.partials.relatorio')
@endsection
