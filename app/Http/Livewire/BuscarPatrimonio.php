<?php

namespace App\Http\Livewire;

use App\Models\Bempatrimoniado;
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

    // form editar
    public $editar; // true or false

    protected $rules = [
        'patrimonio.numpat' => 'integer',
        'patrimonio.setor' => 'string',
        'patrimonio.codlocusp' => 'integer|min:0',
        'patrimonio.codpes' => 'integer|min:1',
    ];

    // protected $queryString = ['numpat'];

    public function updatedNumpat()
    {
        $this->buscar();
    }

    public function buscar()
    {
        $this->bem = Bempatrimoniado::obter($this->numpat);
        $this->patrimonio = Patrimonio::firstOrNew(['numpat' => $this->numpat]);
        $this->dispatchBrowserEvent('update-url', ['url' => 'numpat/' . $this->numpat]);
    }

    public function confirmar()
    {
        //$this->validate();
        $this->authorize('user');
        $this->patrimonio->conferido_em = now();
        $this->patrimonio->user_id = Auth::id();
        $this->patrimonio->replicado = $this->bem;
        $this->patrimonio->save();
        $this->patrimonio->refresh();

        $this->editar = false;
    }

    public function confirmarUndo()
    {
        $this->authorize('user');
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
        $this->authorize('user');
        return view('livewire.buscar-patrimonio')->extends('layouts.app')->slot('content');
    }
}
