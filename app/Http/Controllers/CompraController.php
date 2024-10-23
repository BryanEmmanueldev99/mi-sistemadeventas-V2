<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    
    public function index()
    {
        $compras = Compra::with('user','proveedor','productos');
        return view('admin.compras.index', compact('compras'));
    }

    
    public function create()
    {
        $cart_compras = session()->get('cart_compras');
        if(!$cart_compras):
            $no_session = "Sin sesion";
            //no hagas nada y muestra solo la vista
            return view('admin.compras.create', compact('no_session'));
        else:
            //destruye la sesion existente y muestra la vista
            session()->forget('cart_compras');
            return view('admin.compras.create');
        endif;
    }

    
    public function store(Request $request)
    {
        //
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
