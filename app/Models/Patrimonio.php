<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Uspdev\Replicado\Pessoa;

class Patrimonio extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'numpat',
    ];

    protected $casts = [
        'conferido_em' => 'datetime',
        'replicado' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // static::creating(function ($patrimonio) {
        //     $patrimonio->user_id = Auth::id();
        // });
    }

    public function mostrarBotaoConfirmar()
    {
        return (
            !$this->conferido_em
            || $this->conferido_em->diff(now())->days > 90
        );
    }

    public function mostrarBotaoConfirmarUndo()
    {
        return (
            $this->conferido_em
            && (
                $this->conferido_em->addMinutes(3)->gt(now())
                || \Gate::check('admin')
            )
        );
    }

    public function temPendencias()
    {
        if (
            (!empty($this->codlocusp) && $this->codlocusp != $this->replicado['codlocusp']) ||
            (!empty($this->setor) && $this->setor != $this->replicado['setor']) ||
            (!empty($this->codpes) && $this->codpes != $this->replicado['codpes'])
        ) {
            return true;
        }
        return false;
    }

    /**
     * Cria um novo patrimonio a partir de $numpat e persiste se existir
     */
    public static function importar($filter)
    {
        if (isset($filter['numpat'])) {
            $bem = Bempatrimoniado::obter($filter['numpat']);
            if ($bem) {
                $patrimonio = Patrimonio::firstOrNew(['numpat' => $bem['numpat']]);
                $patrimonio->replicado = $bem;
                $patrimonio->codlocusp = empty($patrimonio->codlocusp) ? $bem['codlocusp'] : $patrimonio->codlocusp;
                $patrimonio->setor = empty($patrimonio->setor) ? $bem['setor'] : $patrimonio->setor;
                $patrimonio->codpes = empty($patrimonio->codpes) ? $bem['codpes'] : $patrimonio->codpes;
                $patrimonio->user_id = \Auth::id();
                $patrimonio->save();
            } else {
                $patrimonio = new Patrimonio;
                $patrimonio->user_id = \Auth::id();
            }

            return $patrimonio;
        }

        if (isset($filter['codlocusp'])) {
            $bensPorLocal = collect(Bempatrimoniado::listarPorSala($filter['codlocusp']));

            foreach ($bensPorLocal as $bem) {
                $patrimonio = Patrimonio::obter($bem);
                $patrimonio->save();
            }
        }
    }

    /**
     * Cria um novo patrimonio a partir de $bem mas não persiste
     */
    public static function obter($bem)
    {
        $patrimonio = Patrimonio::firstOrNew(['numpat' => $bem['numpat']]);
        $patrimonio->replicado = $bem;
        $patrimonio->codlocusp = empty($patrimonio->codlocusp) ? $bem['codlocusp'] : $patrimonio->codlocusp;
        $patrimonio->setor = empty($patrimonio->setor) ? $bem['setor'] : $patrimonio->setor;
        $patrimonio->codpes = empty($patrimonio->codpes) ? $bem['codpes'] : $patrimonio->codpes;
        $patrimonio->user_id = \Auth::id();

        return $patrimonio;
    }

    public function obterNomeCodpes()
    {
        return Pessoa::nomeCompleto($this->codpes);
    }

    /**
     * Relacionamento com user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
