<div class="d-inline float-left">{{ $user->setores }}</div>
<button class="btn py-0 btn-sm btn-outline-primary d-inline float-right" data-toggle="modal"
  data-target="#userSetorModal" data-setores="{{ $user->setores }}">
  <i class="fas fa-edit"></i>
</button>

@Once
  <div class="modal fade" id="userSetorModal" tabindex="-1" aria-labelledby="userSetorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="">
            @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="userSetorModalLabel">Setores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <x-input-text name="setores"></x-input-text>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @section('javascripts_bottom')
    @parent
    <script>
      $('#userSetorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('setores') // Extract info from data-* attributes
        $(this).find('input[name=setores]').val(recipient)
      })

      $('#userSetorModal').on('shown.bs.modal', function(event) {
        console.log('shown')
        $(this).find('input[name=setores]').trigger('focus')
      })
    </script>
  @endsection
@endonce
