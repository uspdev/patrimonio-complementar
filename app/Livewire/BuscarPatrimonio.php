<?php

namespace App\Livewire;

use App\Models\Localusp;
use App\Models\Patrimonio;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BuscarPatrimonio extends Component
{

    use AuthorizesRequests;

    public $numpat;
    public $bem;
    public $patrimonio;
    public $localusp;

    public $setor;
    public $codlocusp;
    public $codpes;
    public $usuario;
    public $local;
    public $obs;

    public $nomeLocal;

    // form editar
    public $editar = false; // true or false

    public function rules()
    {
        return [
            'numpat' => 'required|integer|min:1',
            'setor' => 'required|string',
            'codlocusp' => 'required|integer|min:1',
            'codpes' => 'required|integer|min:1',
            // 'codpes' => [ // esta validação está falhando ...
            //     'required',
            //     function ($attribute, $value, $fail) {
            //         if (empty($this->patrimonio->obterNomeCodpes())) {
            //             $fail('Responsável inválido');
            //         }
            //     },
            // ],
            'usuario' => 'nullable|string',
            'local' => 'nullable|string',
            'obs' => 'nullable|string',
        ];
    }

    // protected $queryString = ['numpat'];
    // protected $listeners = ['refresh' => '$refresh'];

    public function updatedCodlocusp($value)
    {
        $this->nomeLocal = null;

        if (!empty($value) && is_numeric($value)) {
            $local = Localusp::find($value);

            if ($local) {
                $this->nomeLocal = $local->nomloc;
            }
        }
    }

    public function updatedNumpat()
    {
        $this->buscar();
    }

    public function buscar()
    {
        $this->numpat = (int) str_replace('.', '', $this->numpat);
        $this->patrimonio = Patrimonio::importar(['numpat' => $this->numpat]);

        $this->bem = $this->patrimonio->replicado;
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);

        $this->setor = $this->patrimonio->setor;
        $this->codlocusp = $this->patrimonio->codlocusp;
        $this->codpes = $this->patrimonio->codpes;
        $this->usuario = $this->patrimonio->usuario;
        $this->local = $this->patrimonio->local;
        $this->obs = $this->patrimonio->obs;

        $this->dispatch('update-url', ['url' => 'numpat/' . $this->numpat]);
    }

    public function salvar()
    {
        $this->authorize('patrimonios.update', $this->patrimonio);
        $this->validate();
        $this->patrimonio->setor = $this->setor;
        $this->patrimonio->codlocusp = $this->codlocusp;
        $this->patrimonio->codpes = $this->codpes;
        $this->patrimonio->usuario = $this->usuario;
        $this->patrimonio->local = $this->local;
        $this->patrimonio->obs = $this->obs;

        $this->patrimonio->save();
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);
        $this->editar = false;
        $this->dispatch('refresh')->self();
    }

    public function confirmar()
    {
        $this->authorize('patrimonios.update', $this->patrimonio);
        $this->validate();

        $this->patrimonio->conferido_em = now();
        // $this->patrimonio->user_id = Auth::id();
        $this->patrimonio->save();
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);

        $this->editar = false;
        $this->dispatch('refresh')->self();
    }

    public function cancelar()
    {
        $this->patrimonio->refresh();
        $this->editar = false;
    }

    public function confirmarUndo()
    {
        $this->authorize('patrimonios.update', $this->patrimonio);

        $this->patrimonio->conferido_em = null;
        $this->patrimonio->save();
        $this->patrimonio->refresh();
    }

    public function mount($numpat = null)
    {
        $this->authorize('user');
        if ($numpat) {
            $this->buscar();
        }
    }

    public function render()
    {
        \UspTheme::activeUrl('numpat');
        return view('livewire.buscar-patrimonio');
    }
}
