<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = [
         'nombre_proveedor',
         'email_proveedor',
         'celular_proveedor',
         'telefono_proveedor',
         'direccion_fiscal_proveedor',
         'empresa_proveedor'
    ];
}
