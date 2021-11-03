@extends('layouts.app')

@section('content')
  {{-- <div class="h3">
    <a href="?pdf=1">Baixar pdf</a> |

    <hr />
  </div> --}}
  @livewire('buscar-patrimonio')

  {{-- @include('minimo') --}}
  <hr />
  {{-- @include('relatorio') --}}
@endsection
