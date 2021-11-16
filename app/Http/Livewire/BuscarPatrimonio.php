<?php

namespace App\Http\Livewire;

use App\Models\Bempatrimoniado;
use App\Models\Localusp;
use App\Models\Patrimonio;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
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
        'patrimonio.usuario' => 'string|nullable',
        'patrimonio.local' => 'string|nullable',
    ];

    // protected $queryString = ['numpat'];
    // protected $listeners = ['refresh' => '$refresh'];

    public function updatedNumpat()
    {
        $this->buscar();
    }

    public function buscar()
    {
        $this->patrimonio = Patrimonio::importar($this->numpat);
        $this->bem = $this->patrimonio->replicado;
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);

        $this->dispatchBrowserEvent('update-url', ['url' => 'numpat/' . $this->numpat]);
    }

    public function confirmar()
    {
        $this->validate();
        $this->authorize('gerente');
        $this->patrimonio->conferido_em = now();
        $this->patrimonio->user_id = Auth::id();
        $this->patrimonio->replicado = $this->bem;
        $this->patrimonio->save();
        $this->localusp = Localusp::firstOrNew(['codlocusp' => $this->patrimonio->codlocusp]);

        $this->editar = false;
        $this->emitSelf('refresh');
    }

    public function confirmarUndo()
    {
        $this->authorize('gerente');
        $this->patrimonio->conferido_em = null;
        $this->patrimonio->save();
        $this->patrimonio->refresh();
    }

    public function mount()
    {

        if ($this->numpat) {
            $this->buscar();
        }
    }

    public function render()
    {
        $this->authorize('gerente');
        return view('livewire.buscar-patrimonio')->extends('layouts.app')->slot('content');
    }
}
