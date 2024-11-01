<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
         'cantida_producto_orden',
         'precio_producto_orden',
         'producto_id',
         'compra_id',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
}
