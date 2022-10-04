<div class="h5">Registro de alterações (antigo <i class="fas fa-long-arrow-alt-right"></i> novo)</div>
{{-- {{ json_encode($patrimonio->audits()->latest()->first()->getModified()) }} --}}

<div class="ml-3">
  @forelse ($patrimonio->audits()->orderBy('created_at', 'DESC')->get() as $audit)
    <div class="mt-3">
      <b>{{ $audit->created_at->format('d/m/Y H:i') }}</b> ({{ dias($audit->created_at) }}) |
      {{ $audit->user->name }} |
      {{ $audit->event }} <br>

      <table class="table table-sm table-bordered">
        @foreach ($audit->getModified() as $attribute => $modified)
          <tr>
            <td style="white-space: nowrap"><b>{{ $attribute }}</b></td>
            <td style="width:100%;">
              @if ($attribute == 'replicado')
                @foreach ($modified['new'] as $key => $val)
                  {{-- em alguns registros os dados replicados estão incompletos, então precisa testar isset() --}}
                  @if (isset($modified['new'][$key]) && isset($modified['old'][$key]) && $modified['new'][$key] == $modified['old'][$key])
                    {{-- mostrar dados que não foram alterados --}}
                    {{-- {{ $key }}: {{ $modified['new'][$key] }} [OK] <br> --}}
                  @else
                    {{ $key }}: {{ $modified['old'][$key] ?? 'null' }} <i
                      class="fas fa-long-arrow-alt-right"></i>
                    {{ $modified['new'][$key] ?? '-' }}<br>
                  @endif
                @endforeach
              @else
                {{ json_encode($modified['old'] ?? 'null', JSON_PRETTY_PRINT) }} 
                <i class="fas fa-long-arrow-alt-right"></i>
                {{ json_encode($modified['new'], JSON_PRETTY_PRINT) }}
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @empty
    <p>@lang('article.unavailable_audits')</p>
  @endforelse
</div>
