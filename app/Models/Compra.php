<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
         'nro_compra',
         'comprobante_compra',
         'precio_compra',
         'fecha_compra',
         'cantidad_compra',
         'user_id',
         'proveedor_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function proveedor() 
    {
        return $this->belongsTo(Proveedor::class);
    }

    // public function productos()
    // {
    //     return $this->belongsToMany(Producto::class);
    // }

    public function ordercompra(){
        return $this->hasOne(OrdenCompra::class);
    }
}
