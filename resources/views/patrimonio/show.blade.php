@extends('layouts.app')

@section('content')
{{-- {{ $numpat }} --}}
  @livewire('buscar-patrimonio', ['numpat' => $numpat])
@endsection
