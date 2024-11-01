<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{

    private function session_destroy_compras() {
        $cart_compras = session()->get('cart_compras');
        session()->forget('cart_compras');
    }
    
    public function index()
    {
        $this->session_destroy_compras();
        $compras = Compra::with('user','proveedor')->get();
        return view('admin.compras.index', compact('compras'));
    }

    
    public function create()
    {
        $productos = Producto::with('user','categoria')->get();
        $proveedores = Proveedor::get();
        return view('admin.compras.create', compact('productos','proveedores')); 
    }


    public function agregar_carro_compras(Request $request, $id) {
        $producto = Producto::findOrFail($id);
        $quantity = $request['cantidad_carrito'];
        $cart_compras = session()->get('cart_compras');

          //si no hay sesion del carrito, entonces genera una primera sesion
          if(!$cart_compras) :
            $cart_compras=[

                $id => [
                    "producto" => $producto->nombre_producto,
                    "quantity" => $quantity,
                    "sku" => $producto->sku,
                    "descripcion" => $producto->descripcion,
                    "precio_compra" => $producto->precio_compra,
                    "precio_venta" => $producto->precio_venta,
                    "fecha_ingreso" => $producto->fecha_ingreso,
                    "user_id" => $producto->user_id,
                    "categoria_id" => $producto->categoria_id,
                    "imagen_producto" => $producto->imagen_producto,
                ]

            ];
           
            session()->put('cart_compras', $cart_compras);
            //session()->has('cart_compras');
            return redirect()->back();
        endif;


        // if cart not empty then check if this product exist then increment quantity

        if(isset($cart_compras[$id])) :
            if($quantity <= 0) :
                return redirect()->back()->with('error', 'Porfavor selecciona una cantidad válida.');
            endif;
             
                if($request['cantidad_carrito'] == 1) :
                $cart_compras[$id]['quantity']++;
                session()->put('cart_compras', $cart_compras);
                return redirect()->back()->with('success', '¡Carrito actualizado!');
                endif;

                $quantity = $cart_compras[$id]['quantity'] + $request['cantidad_carrito'];
                $cart_compras[$id]=[
                    "producto" => $producto->nombre_producto,
                    "quantity" => $quantity,
                    "sku" => $producto->sku,
                    "descripcion" => $producto->descripcion,
                    "precio_compra" => $producto->precio_compra,
                    "precio_venta" => $producto->precio_venta,
                    "fecha_ingreso" => $producto->fecha_ingreso,
                    "user_id" => $producto->user_id,
                    "categoria_id" => $producto->categoria_id,
                    "imagen_producto" => $producto->imagen_producto,
            ];
                session()->put('cart_compras', $cart_compras);
                return redirect()->back()->with('success', '¡Carrito actualizado!');

        endif;

         // if item not exist in cart then add to cart with quantity = 1
        $cart_compras[$id]=[
                   "producto" => $producto->nombre_producto,
                    "quantity" => $quantity,
                    "sku" => $producto->sku,
                    "descripcion" => $producto->descripcion,
                    "precio_compra" => $producto->precio_compra,
                    "precio_venta" => $producto->precio_venta,
                    "fecha_ingreso" => $producto->fecha_ingreso,
                    "user_id" => $producto->user_id,
                    "categoria_id" => $producto->categoria_id,
                    "imagen_producto" => $producto->imagen_producto,
        ];

        session()->put('cart_compras', $cart_compras);
        return redirect()->back()->with('success', '¡'.$producto->nombre_producto.' se ha añadido a tu carrito.!');
    }



    
    public function store(Request $request)
    {
        // $data = $request->all();
        // dd($data);

        $cart_compras = session()->get('cart_compras');
        $user_id = Auth::user()->id;
        $compra = Compra::create([
            'nro_compra' => $request->nro_compra,
            'id_proveedor' => $request->id_proveedor,
            'fecha_compra' => $request->fecha_compra,
            'comprobante_compra' => $request->comprobante_compra,
            'precio_compra' => $request->precio_compra,
            'cantidad_compra' => $request->cantidad_compra,
            'proveedor_id' => $request->id_proveedor,
            'user_id' => $user_id
        ]);

        foreach (session('cart_compras') as $id => $details) :
            $precio_producto_orden = $details['precio_compra']  * $details['quantity'];
            OrdenCompra::create([
                'cantida_producto_orden' => $details['quantity'],
                'producto_id' => $id,
                'precio_producto_orden' => $precio_producto_orden,
                'compra_id' => $compra->id,
            ]);
        endforeach;

        return redirect('admin/compras')->with('success','¡Compra agregada con exito!');
    }

    
    public function edit(Compra $compra)
    {
        $cart_compras = session()->get('cart_compras');
        if(!$cart_compras):
            //no hagas nada y muestra solo la vista
            return view('admin.compras.edit');
        else:
            //destruye la sesion existente y muestra la vista
            session()->forget('cart_compras');
            return view('admin.compras.edit');
        endif;
    }


    public function update(Request $request, Compra $compra)
    {
        //
    }

   
    public function destroy(Compra $compra)
    {
        //
    }
}
