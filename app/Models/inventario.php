<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_inventario';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'hora',
        'cantidad_ingresada',
        'cantidad_total',
        'id_producto'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function historial()
    {
        return $this->hasMany(inventario_historial::class, 'id_inventario');
    }

    public function detalleVentas()
    {
        return $this->hasMany(detalle_venta::class, 'id_inventario');
    }
}
