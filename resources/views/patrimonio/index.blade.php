@extends('layouts.app')

@section('content')
  @can('gerente')
    <div class="row">
      <div class="col-md-6">
        <div class="card h4 text-warning">
          <div class="card-header">
            Buscar por
          </div>
          <div class="card-body">
            <form id="form-numpat" action="{{ route('buscarPorNumpat') }}">
              <x-input-text name="numpat" prepend="Patrimônio">
                <button id="searchNumpat" class="btn btn-sm btn-primary ml-1">OK</button>
              </x-input-text>
            </form>

            <form id="form-localusp" action="{{ route('buscarPorLocal') }}">
              <x-input-number name="codlocusp" prepend="Local">
                <button id="searchCodlocusp" class="btn btn-sm btn-primary ml-1">OK</button>
              </x-input-number>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endcan

  @if ($patrimonios->isNotEmpty())
    <div class="h4 mt-3">
      Meus Patrimônios <span class="badge badge-primary">{{ count($patrimonios) }}</span>
    </div>
    @include('partials.listagem')
  @endif
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $('#form-localusp').submit(function(e) {
      e.preventDefault(e)
      window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=codlocusp]').val()
      // console.log(codlocusp)
    })

    $('#form-numpat').submit(function(e) {
      e.preventDefault(e)
      window.location.href = $(this).attr('action') + '/' + $(this).find('input[name=numpat]').val()
      // console.log(codlocusp)
    })
  </script>
@endsection
