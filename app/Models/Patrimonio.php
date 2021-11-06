<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Patrimonio extends Model
{
    use HasFactory;

    protected $fillable = [
        'numpat',
    ];

    protected $casts = [
        'conferido_em' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($patrimonio) {
            $patrimonio->user_id = Auth::id();
        });
    }

    /**
     * Relacionamento com user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
