@extends('layouts.app')

@section('content')

  <h2 class="text-danger">
      Acesso negado!!
  </h2>
  Faça <a href="{{ route('login') }}">login</a> para acessar esta página.

@endsection
