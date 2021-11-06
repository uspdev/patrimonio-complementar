<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Patrimonio;
use Illuminate\Http\Request;
use App\Models\Bempatrimoniado;
use Illuminate\Support\Facades\Auth;

class BuscarPatrimonio extends Component
{

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

    public function buscar() {
        $this->bem = Bempatrimoniado::obter($this->numpat);
        $this->patrimonio = Patrimonio::firstOrNew(['numpat' => $this->numpat]);
    }

    public function confirmar() {
        //$this->validate();
        //$this->patrimonio = Patrimonio::firstOrNew(['numpat' => $this->numpat]);
        $this->patrimonio->conferido_em = now();
        $this->patrimonio->save();
        $this->editar = false;
    }

    public function confirmarUndo() {
        $this->patrimonio->delete();
        $this->patrimonio = Patrimonio::firstOrNew(['numpat' => $this->numpat]);
    }

    public function render()
    {
        return view('livewire.buscar-patrimonio');
    }
}
