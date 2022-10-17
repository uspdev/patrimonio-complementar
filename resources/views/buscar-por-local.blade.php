@extends('layouts.app')

@section('content')

  <div class="mb-3">
    <form id="form-localusp" method="GET" action="{{ route('buscarPorLocal') }}">
      Numero da sala
      <input type="number" name="codlocusp" />
      <button class="btn btn-sm btn-primary" type="submit">OK</button>
    </form>
  </div>

  <div class="h4 mb-3">
    LocaUSP <b>{{ $localusp->codlocusp }}</b> | Nome {{ $localusp->nome }}
    | Andar {{ $localusp->andar }} | Setor {{ $localusp->setor }}
    <span class="badge badge-primary">{{ count($patrimonios) }} registros</span>
  </div>

  @if (count($patrimonios))
    @include('partials.listagem')
  @else
    @if ($localusp->codlocusp)
      Não foram encontrados registros na sala {{ $localusp->codlocusp }}
    @endif
  @endif


@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {
      $('#form-localusp').submit(function(e) {
        e.preventDefault(e)
        window.location.href = $(this).attr('action') + '/' + $(this).find(':input[name=codlocusp]').val()
        console.log('ok')
      })
    })
  </script>

@endsection
