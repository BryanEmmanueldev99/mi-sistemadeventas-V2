<?php

namespace App\Http\Requests\productos;

use Illuminate\Foundation\Http\FormRequest;

class ProductoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'nombre_producto' => 'required|max:150',
          'sku' => 'nullable|max:70',
          'descripcion' => 'nullable',
          'stock' => 'required',
          'precio_compra' => 'required',
          'precio_venta' => 'required',
          'fecha_ingreso' => 'nullable|date',
          'imagen_producto' => 'nullable',
          'categoria_id' => 'required|integer'
        ];
    }
}
