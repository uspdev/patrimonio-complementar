<?php

namespace App\Models;

use Uspdev\Replicado\Pessoa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
                || Gate::check('admin')
            )
        );
    }

    public function temPendencias()
    {
        if (
            (!empty($this->codlocusp) && $this->codlocusp != $this->replicado['codlocusp']) ||
            (!empty($this->setor) && $this->setor != $this->replicado['sglcendsp']) ||
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

        if (isset($filter['bem'])) {
            $patrimonio = SELF::obter($filter['bem']);
            $patrimonio->save();
            return $patrimonio;
        }

        if (isset($filter['numpat'])) {
            $bem = Bempatrimoniado::obter($filter['numpat']);
            if ($bem) {
                $patrimonio = SELF::obter($bem);
                $patrimonio->save();
            } else {
                $patrimonio = new Patrimonio;
                $patrimonio->user_id = Auth::id();
            }
            return $patrimonio;
        }

        if (isset($filter['codlocusp'])) {
            foreach (Bempatrimoniado::listarPorSala($filter['codlocusp']) as $bem) {
                $patrimonio = SELF::obter($bem);
                $patrimonio->save();
            }
        }

        if (isset($filter['codpes'])) {
            foreach (Bempatrimoniado::listarPorResponsavel($filter['codpes']) as $bem) {
                $patrimonio = SELF::obter($bem);
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
        if (json_encode($patrimonio->replicado) != json_encode($bem)) {
            // dd($bem, $patrimonio->replicado);
            $patrimonio->replicado = $bem;
        }
        $patrimonio->codlocusp = empty($patrimonio->codlocusp) ? $bem['codlocusp'] : $patrimonio->codlocusp;
        $patrimonio->setor = empty($patrimonio->setor) ? $bem['sglcendsp'] : $patrimonio->setor;
        $patrimonio->codpes = empty($patrimonio->codpes) ? $bem['codpes'] : $patrimonio->codpes;
        $patrimonio->user_id = empty($patrimonio->user_id) ? Auth::id() : $patrimonio->user_id;

        return $patrimonio;
    }

    public function obterNomeCodpes()
    {
        return Pessoa::nomeCompleto($this->codpes);
    }

    public function localusp() {
        return Localusp::where('codlocusp', $this->codlocusp)->first();
    }

    /**
     * Relacionamento com user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
