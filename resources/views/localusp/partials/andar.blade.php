{{ $localusp->andar }}
@if ($localusp->andar != $localusp->replicado['idfadr'])
  <span class="text-danger">
    (USP: {{ $localusp->replicado['idfadr'] ?? '' }})
  </span>
@endif
