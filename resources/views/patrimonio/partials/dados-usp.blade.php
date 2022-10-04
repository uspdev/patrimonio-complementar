<div class="h5">Dados registrados no Sistema Mercúrio</div>

<div class="ml-3">
  @foreach ($bem as $key => $val)
  @if($val)
    <div>
      <span>{{ $key }}</span>:
      <span class="font-weight-bold">{{ $val }}</span>
    </div>
    @endif
  @endforeach
  </div>

  {{-- formatado em tabela --}}
{{-- <table class="table table-sm table-bordered table-striped table-condensed">
  @foreach ($bem as $key => $val)
  @if($val)
    <tr>
      <td>{{ $key }}</td>
      <td>{{ $val }}</td>
    </tr>
    @endif
  @endforeach
</table> --}}

