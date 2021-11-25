@extends('layouts.app')

@section('content')

  <div class="h4">Buscar por</div>

  <form id="form-numpat" action="{{ route('buscarPorNumpat') }}">
    <x-input-number name="numpat" prepend="Patrimônio">
      <button id="searchNumpat" class="btn btn-sm btn-primary ml-1">OK</button>
    </x-input-number>
  </form>

  <form id="form-localusp" action="{{ route('buscarPorLocal') }}">
    <x-input-number name="codlocusp" prepend="Local">
      <button id="searchCodlocusp" class="btn btn-sm btn-primary ml-1">OK</button>
    </x-input-number>
  </form>

@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $('#form-localusp').submit(function(e) {
      e.preventDefault(e)
      window.location.href =  $(this).attr('action') + '/' + $(this).find('input[name=codlocusp]').val()
      // console.log(codlocusp)
    })

    $('#form-numpat').submit(function(e) {
    e.preventDefault(e)
    window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=numpat]').val()
    // console.log(codlocusp)
    })
  </script>

@endsection
