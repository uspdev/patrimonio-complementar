<?php

namespace App\Models;

use Uspdev\Replicado\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localusp extends Model
{
    use HasFactory;

    protected $fillable = [
        'codlocusp',
    ];

    protected $casts = [
        'replicado' => 'array',
    ];

    public static function importar()
    {

        $query = "SELECT * FROM LOCALUSP WHERE codund IN (" . getenv('REPLICADO_CODUNDCLG') .")";

        $locaisReplicado = DB::fetchAll($query);
        foreach ($locaisReplicado as $localReplicado) {
            $localusp = Localusp::firstOrNew(['codlocusp' => $localReplicado['codlocusp']]);
            $localusp->replicado = $localReplicado;
            $localusp->setor = $localusp->setor ?? $localReplicado['idfblc'];
            $localusp->andar = $localusp->andar ?? $localReplicado['idfadr'];
            $localusp->nome = $localusp->nome ?? $localReplicado['idfloc'];
            $localusp->save();
        }
    }

    // lista os patrimonios do local
    public function patrimonios() {
        return Patrimonio::where('codlocusp', $this->codlocusp)->orderBy('numpat')->get();
    }

    public function contarPatrimonios() {
        return Patrimonio::where('codlocusp', $this->codlocusp)->count();

    }

}
