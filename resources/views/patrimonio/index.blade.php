@extends('layouts.app')

@section('content')

  @livewire('buscar-patrimonio',['numpat'=>$numpat])

@endsection
