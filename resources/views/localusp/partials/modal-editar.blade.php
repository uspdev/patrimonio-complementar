<button class="btn py-0 btn-sm d-inline float-right" data-toggle="modal" data-target="#userSetorModal"
  data-localusp="{{ $localusp->toJson() }}" data-action="localusp/{{ $localusp->id }}">
  <i class="fas fa-edit"></i>
</button>

@Once

  @section('modais')
    @parent
    <div class="modal fade" id="userSetorModal" tabindex="-1" aria-labelledby="userSetorModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="userSetorModalLabel">Editando Local <span id="codlocusp"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <x-input-text name="setor" prepend="Setor"></x-input-text>
              <x-input-text name="andar" prepend="Andar"></x-input-text>
              <x-input-text name="nome" prepend="Nome"></x-input-text>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endsection

  @section('javascripts_bottom')
    @parent
    <script>
      $(document).ready(function() {
        $('#userSetorModal').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal

          $(this).find('#codlocusp').text(button.data('localusp').codlocusp)
          $(this).find('input[name=setor]').val(button.data('localusp').setor)
          $(this).find('input[name=andar]').val(button.data('localusp').andar)
          $(this).find('input[name=nome]').val(button.data('localusp').nome)

          console.log(button.data('localusp'))
          $(this).find('form').attr('action', button.data('action'))
        })

        $('#userSetorModal').on('shown.bs.modal', function(event) {
          console.log('shown')
          $(this).find('input[name=setores]').trigger('focus')
        })
      })
    </script>
  @endsection
@endonce
