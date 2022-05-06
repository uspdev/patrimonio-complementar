<div class="text-danger">
  @if (empty($numpat))
    Informe um número de patrimônio.
  @else
    Patrimônio {{ formatarNumpat($numpat) }} não encontrado!
  @endif
</div>
