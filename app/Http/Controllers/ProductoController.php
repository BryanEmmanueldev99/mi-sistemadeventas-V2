<?php

namespace App\Http\Controllers;

use App\Http\Requests\productos\ProductoStoreRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index() {
        $productos = Producto::with('categoria', 'user')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create() {
        $categorias = Categoria::get();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(ProductoStoreRequest $request) {

        $producto = new Producto();
        if($request->hasFile('imagen_producto')):
            $producto->imagen_producto = $request->imagen_producto;
            $producto['imagen_producto'] = $request->file('imagen_producto')->store('productos','public');
        else:
            //No hagas nada
        endif;

        $producto->nombre_producto = $request->nombre_producto;
        $producto->sku = $request->sku;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->user_id = Auth::user()->id;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        return redirect('admin/productos')->with('success','¡Producto agregado con exito!'); 
    }

    public function get_Producto($id) {
          $producto = Producto::findOrFail($id);
          return view('admin.productos.recuperar_producto', compact('producto'));
    }

    public function update(ProductoStoreRequest $request, $id) {
        $producto = Producto::findOrFail($id);
        $path_producto = $producto->imagen_producto;

        $producto->nombre_producto = $request->nombre_producto;
        $producto->sku = $request->sku;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->user_id = Auth::user()->id;
        $producto->categoria_id = $request->categoria_id;
        if($request->hasFile('imagen_producto')):
            $producto->imagen_producto = $request->imagen_producto;
            Storage::delete('public/'.$path_producto);
            $producto['imagen_producto'] = $request->file('imagen_producto')->store('productos','public');
        else:
            //No hagas nada
        endif;

        $producto->save();
        return back()->with('success','¡Producto actualizado con exito!');
    }

    public function destroy($id) {
        $producto = Producto::findOrFail($id);
        $path_producto = $producto->imagen_producto;
        Storage::delete('public/'.$path_producto);

        $producto->delete();
        return back()->with('success','¡El producto se elimino con exito!');
    }

}
