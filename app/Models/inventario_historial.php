<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario_historial extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_historial';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'hora',
        'cantidad_ingresada',
        'id_inventario'
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id_inventario');
    }
}
