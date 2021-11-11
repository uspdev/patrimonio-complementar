<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

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

    public function temPendencias($bem = null)
    {
        if ($bem) {
            if (
                (!empty($this->codlocusp) && $this->codlocusp != $bem['codlocusp']) ||
                (!empty($this->setor) && $this->setor != $bem['setor']) ||
                (!empty($this->codpes) && $this->codpes != $bem['codpes'])
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Relacionamento com user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
