<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categoria\CategoriaStoreRequest;
use App\Http\Requests\Categoria\CategoriaUpdateRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    
    public function index()
    {
        $categorias = Categoria::with('productos')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(CategoriaStoreRequest $request)
    {
           $categoria = new Categoria();
           $categoria->nombre_categoria = $request->nombre_categoria;
           $categoria->save();
           return redirect('admin/categorias')->with('success','¡Categoria agregada con exito!');    
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(CategoriaUpdateRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();
        return back()->with('success','¡Categoria actualizada con exito!');  
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return back()->with('success','¡Categoria eliminada exitosamente!');
    }
}
