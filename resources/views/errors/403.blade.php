@extends('layouts.app')

@section('content')
  <div class="h5 mb-4">
    Gerencia dados complementares ao sistema patrimonial da USP.
  </div>
  @if (Gate::check('user'))
    <h4 class="text-danger">
      Acesso negado!!
    </h4>
    Você não tem privilégios para acessar esse recurso.
  @else
    Faça <a href="{{ route('login') }}">login</a> para acessar esta página.
  @endif
@endsection
