<?php

namespace App\Http\Livewire;

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

    // form editar
    public $editar; // true or false

    protected $rules = [
        'patrimonio.numpat' => 'integer',
        'patrimonio.setor' => 'required|string',
        'patrimonio.codlocusp' => 'required|integer',
        'patrimonio.codpes' => 'required|integer|min:1',
        'patrimonio.usuario' => 'nullable|string',
        'patrimonio.local' => 'nullable|string',
        'patrimonio.obs' => 'nullable|string',
    ];

    // protected $queryString = ['numpat'];
    // protected $listeners = ['refresh' => '$refresh'];

    public function updatedNumpat()
    {
        $this->buscar();
    }

    public function buscar()
    {
        $this->numpat = str_replace('.', '', $this->numpat);
        $this->patrimonio = Patrimonio::importar(['numpat' => $this->numpat]);
        $this->bem = $this->patrimonio->replicado;
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);

        $this->dispatchBrowserEvent('update-url', ['url' => 'numpat/' . $this->numpat]);
    }

    public function salvar()
    {
        $this->authorize('patrimonios.update', $this->patrimonio);
        $this->validate();
        // esta lógica deve ir para dentro da validação
        if (!$this->patrimonio->obterNomeCodpes()) {
            $this->addError('patrimonio.codpes', 'Responsável inválido');
            $this->emitSelf('refresh');
            return null;
        }
        $this->patrimonio->save();
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);
        $this->editar = false;
        $this->emitSelf('refresh');
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
        $this->emitSelf('refresh');
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

    public function mount()
    {
        $this->authorize('user');
        $this->numpat && $this->buscar();
    }

    public function render()
    {
        \UspTheme::activeUrl('numpat');
        return view('livewire.buscar-patrimonio')->extends('layouts.app')->slot('content');
    }
}
