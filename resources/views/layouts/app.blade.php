@extends('laravel-usp-theme::master')

@section('styles')
  @parent
  @livewireStyles
  <style>
    /*seus estilos*/
  </style>
@endsection

@include('laravel-usp-theme::blocos.datatable-simples')
@include('laravel-usp-theme::blocos.spinner')

@section('flash')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if (Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
          <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a>
        </p>
      @endif
    @endforeach
  </div>
@endsection

@section('skin_footer')
  @parent
  {{-- Seu código --}}
@endsection

@section('javascripts_bottom')
  @yield('modais')
  @parent
  @livewireScripts
  <script>
    // Seu código .js
  </script>
@endsection
