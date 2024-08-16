<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_unitario'
    ];

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'id_producto');
    }
}
