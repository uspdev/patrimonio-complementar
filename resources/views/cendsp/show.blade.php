@extends('layouts.app')

@section('content')
  <h4 class="mb-3">
    <a href="cendsp">Centros de despesa</a> > {{ $sglcendsp }} <span
      class="badge badge-primary">{{ count($patrimonios) }}</span>
  </h4>

  @include('partials.listagem')
@endsection
