@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('styles')
  @parent
  @livewireStyles
  <style>
    /*seus estilos*/

  </style>
@endsection

@section('skin_footer')
  @parent
  {{-- Seu código --}}
@endsection

@section('javascripts_bottom')
  @parent
  @livewireScripts
  <script>
    // Seu código .js
  </script>
@endsection
