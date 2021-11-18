@extends('layouts.app')

@section('content')

  @if (Gate::check('user'))
    <h4 class="text-danger">
      Acesso negado!!
    </h4>
    Você não tem privilégios para acessar esse recurso.
  @else
    Faça <a href="{{ route('login') }}">login</a> para acessar esta página.
  @endif

@endsection
