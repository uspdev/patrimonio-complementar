<div class="h5">Dados USP</div>
<table class="table table-sm table-bordered table-striped table-condensed">
  @foreach ($bem as $key => $val)
  @if($val)
    <tr>
      <td>{{ $key }}</td>
      <td>{{ $val }}</td>
    </tr>
    @endif
  @endforeach
</table>