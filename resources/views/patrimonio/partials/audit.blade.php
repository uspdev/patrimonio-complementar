@if ($patrimonio)
  <div class="row">
    <div class="col-md-12">

      <div class="h5">Registro de alterações</div>
      {{-- {{ json_encode($patrimonio->audits()->latest()->first()->getModified()) }} --}}
      @foreach ($patrimonio->audits()->orderBy('created_at', 'DESC')->get() as $audit)
        {{ $audit->user->name }}
        {{ $audit->created_at->format('d/m/Y H:i') }} ({{ dias($audit->created_at) }})
        {{ $audit->event }} <br>
        {{ $audit->getModified(true, JSON_PRETTY_PRINT) }} <br><br>
        {{-- {{ Json_encode($audit) }} --}}
      @endforeach
    </div>
  </div>

@endif
