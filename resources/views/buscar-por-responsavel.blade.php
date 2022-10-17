@extends('layouts.app')

@section('styles')
  @parent
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.css"
    integrity="sha512-AQG3JVpy/h0TsLsFs/HDLjnkq1ih9uUliGGXdQ7LQcGQt7GD+1b7HWOQ2oeCH7tKdtrfRg75CGApafi+//9Dbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@endsection

@section('content')
  <div class="h4">Buscar por Responsável</div>

  <form id="form-responsavel" action="{{ route('buscarPorResponsavel') }}">
    <x-senhaunica::select-pessoa prepend="Responsável">
      <input type="submit" class="btn btn-sm btn-primary ml-1" value="OK">
    </x-senhaunica::select-pessoa>
  </form>

  <div class="bold">
    {{ $user->codpes }} - {{ $user->name }} <span class="badge badge-primary">{{ count($patrimonios) ?? 0 }}</span>
  </div>

  @if ($patrimonios->isNotEmpty())
    @include('partials.listagem')
  @endif
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {
      $('#form-responsavel').submit(function(e) {
        e.preventDefault(e)
        window.location.href = $(this).attr('action') + '/' + $(this).find(':input[name=codpes] option').filter(
          ':selected').val()
        console.log('ok')
      })
    })
  </script>
@endsection
