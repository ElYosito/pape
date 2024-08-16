<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_venta';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'hora',
        'total'
    ];

    public function detalleVentas()
    {
        return $this->hasMany(detalle_venta::class, 'id_venta');
    }
}
