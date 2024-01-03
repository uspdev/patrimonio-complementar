{{ $localusp->setor }}
@if ($localusp->setor != $localusp->replicado['idfblc'])
  <span class="text-danger">
    (USP: {{ $localusp->replicado['idfblc'] ?? '' }})
  </span>
@endif
