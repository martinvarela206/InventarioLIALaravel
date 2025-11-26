<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';
    public $timestamps = false;

    protected $fillable = [
        'nro_lia',
        'user_id',
        'estado',
        'ubicacion',
        'fecha',
        'comentario',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function elemento()
    {
        return $this->belongsTo(Elemento::class, 'nro_lia', 'nro_lia');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
