<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::get();
        return view('admin.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|max:255',
            'celular_proveedor' => 'nullable|numeric',
            'email_proveedor' => 'nullable|unique:proveedors,email_proveedor|email',
            'telefono_proveedor' => 'nullable|numeric',
            'empresa_proveedor' => 'required|max:255',
        ]); 
        Proveedor::create($request->all());
        return redirect('admin/proveedores')->with('success','¡Proveedor agregado con exito!'); 
    }


    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }


    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $request->validate([
            'nombre_proveedor' => 'required|max:255',
            'celular_proveedor' => 'nullable|numeric',
            'email_proveedor' => 'nullable|unique:proveedors,email_proveedor,'.$proveedor->id.'|email',
            'telefono_proveedor' => 'nullable|numeric',
            'empresa_proveedor' => 'required|max:255',
        ]); 
        $proveedor->update($request->all());
        return back()->with('success','¡Proveedor actualizado con exito!');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return back()->with('success','¡Proveedor eliminado con exito!');
    }
}
