<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
          'nombre_producto',
          'sku',
          'descripcion',
          'stock',
          'precio_compra',
          'precio_venta',
          'fecha_ingreso',
          'imagen_producto',
          'user_id',
          'categoria_id'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
   }

   public function user() {
        return $this->belongsTo(User::class);
   }

  //  public function compra() 
  //  {
  //    return $this->belongsTo(Compra::class);
  //  }

   public function ordercompra(){
     return $this->hasOne(OrdenCompra::class);
   }
}
