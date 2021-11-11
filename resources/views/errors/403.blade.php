@extends('layouts.app')

@section('content')

  <h2 class="text-danger">
    Acesso negado!!
  </h2>
  @if (Gate::check('user'))
    Você não tem privilégios para acessar esse recurso.
  @else
    Faça <a href="{{ route('login') }}">login</a> para acessar esta página.
  @endif

@endsection
