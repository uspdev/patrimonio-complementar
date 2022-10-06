{{-- Deve passar $numpat como parâmetro --}}
<a class="btn btn-secondary" id="abrir-mercurio"
  href="https://uspdigital.usp.br/mercurioweb/merPatrimonioListar.jsp?codmnu=2421" target="_MERCURIO_WEB">
  Mercúrio <i class="fas fa-external-link-alt"></i>
</a>
<input id="numpat" type="hidden" name="numpat" value="{{ $numpat }}">

@once
  @section('javascripts_bottom')
    @parent
    <script>
      //https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
      $('#abrir-mercurio').on('click', function(e) {
        // e.preventDefault();
        var numpat = $('#numpat')
        if (navigator.clipboard) {
          navigator.clipboard.writeText(numpat.val())
          console.log('Numpat ', numpat)
        } else {
          alert("Use uma conexão HTTPS para copiar numpat para a área de transferência!")
        }
      })
    </script>
  @endsection
@endonce
