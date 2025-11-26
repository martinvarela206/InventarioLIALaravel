<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Elemento extends Model
{
    use HasFactory;

    protected $table = 'elementos';
    protected $primaryKey = 'nro_lia';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nro_lia',
        'nro_unsj',
        'tipo',
        'descripcion',
        'cantidad',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'nro_lia', 'nro_lia');
    }

    public function ultimoMovimiento()
    {
        return $this->hasOne(Movimiento::class, 'nro_lia', 'nro_lia')->latestOfMany('fecha');
    }
}
