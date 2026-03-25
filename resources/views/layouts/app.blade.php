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

@stack('scripts')