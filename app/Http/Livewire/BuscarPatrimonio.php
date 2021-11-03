<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Bempatrimoniado;

class BuscarPatrimonio extends Component
{

    public $numpat;
    public $bem;

    public function atualizarNumpat() {
        //  dd($request->numpat);
        $this->bem = Bempatrimoniado::obter($this->numpat);
    }

    public function render()
    {
        return view('livewire.buscar-patrimonio');
    }
}
