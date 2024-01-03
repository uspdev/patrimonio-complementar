<?php

namespace App\Models;

use Uspdev\Replicado\DB;
use App\Replicado\Bempatrimoniado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localusp extends Model
{
    use HasFactory;

    protected $fillable = [
        'codlocusp', 'setor', 'andar', 'nome',
    ];


    protected $casts = [
        'replicado' => 'array',
    ];

    /**
     * Lê as informações do replicado e preenche a base local
     *
     * @return null
     */
    public static function importar()
    {
        $query = "SELECT * FROM LOCALUSP WHERE codund IN (" . config('replicado.codundclgs') . ")";

        $locaisReplicado = DB::fetchAll($query);
        $count = 0;
        foreach ($locaisReplicado as $localReplicado) {
            $localusp = Localusp::firstOrNew(['codlocusp' => $localReplicado['codlocusp']]);
            $localusp->replicado = $localReplicado;
            $localusp->setor = $localusp->setor ?? $localReplicado['idfblc'];
            $localusp->andar = $localusp->andar ?? $localReplicado['idfadr'];
            $localusp->nome = $localusp->nome ?? $localReplicado['idfloc'];
            if (!$localusp->exists) {
                $count++;
            }
            $localusp->save();
        }
        return $count;
    }

    // lista os patrimonios do local
    public function patrimonios()
    {
        Patrimonio::importar(['codlocusp' => $this->codlocusp]);
        $patrimonios = Patrimonio::where('codlocusp', $this->codlocusp)->where('replicado->stabem', 'Ativo')->orderBy('numpat')->get();
        return $patrimonios;
    }

    public function contarPatrimonios()
    {
        return Patrimonio::where('codlocusp', $this->codlocusp)->count();

    }

}
