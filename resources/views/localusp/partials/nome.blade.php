{{ $localusp->nome }}
@if ($localusp->nome != $localusp->replicado['idfloc'])
  <span class="text-danger">
    (USP: {{ $localusp->replicado['idfloc'] }})
  </span>
@endif