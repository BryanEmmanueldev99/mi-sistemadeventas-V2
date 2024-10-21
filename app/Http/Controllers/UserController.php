<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private function provider_sesion() {
        
    }

    public function index()
    {
        // $session_start_usuario = session()->get('session_start_usuario');
        // if(Auth::check() && $session_start_usuario) :
          //no hagas nada, conserva la sesion
          $usuarios = User::get();
          return view('admin.usuarios.index', compact('usuarios'));
        // else :
        //   return redirect('/');
        // endif;
    }


    public function create()
    {
          //no hagas nada, conserva la sesion
          return view('admin.usuarios.create');
    }


    public function store(UserStoreRequest $request)
    {
        // $session_start_usuario = session()->get('session_start_usuario');
        // if(Auth::check() && $session_start_usuario) :
        //   //no hagas nada, conserva la sesion
         if($request->password == $request->password_confirmation) {

            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request['password']);
            $usuario->save();

         return redirect('/admin/usuarios')->with('success','¡Usuario agregado con exito!');
         } elseif ($request->password != $request->password_confirmation){
            return back()->with('password_confirmation','Las contraseñas no coinciden.');
         } else {
            return back()->with('password_confirmation','La confirmación de la contraseña es requerida.');
         }
         
        // else :
        //   return redirect('/');
        // endif;
    }


    public function edit($id)
    {
      // $session_start_usuario = session()->get('session_start_usuario');
      // if(Auth::check() && $session_start_usuario) :
      //   //no hagas nada, conserva la sesion
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.editar_usuario',compact('usuario'));
      // else :
      //   return redirect('/');
      // endif;
    }

    
    public function update(Request $request, $id)
    {
      // $session_start_usuario = session()->get('session_start_usuario');
      // if(Auth::check() && $session_start_usuario) :

        $usuario = User::findOrFail($id);
        $request->validate([
          'name'     => 'required|max:250',
          'email'    => 'required|max:250|unique:users,email,'.$usuario->id,
          'password' => 'nullable|max:250|confirmed'
       ]);

        if($request->password) {

          if($request->password == $request->password_confirmation) {
            $usuario->password = Hash::make($request['password']);
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->save();
  
            return back()->with('success','¡Usuario actualizado con exito!');
          }else{
            return back()->with('password_confirmation','Las contraseñas no coinciden.');
          }

        }else{
          $usuario->name = $request->name;
          $usuario->email = $request->email;
          $usuario->save();

           return back()->with('success','¡Usuario actualizado con exito!');
        }
        
      // else :
      //   return redirect('/');
      // endif;
    }

   
    public function destroy($id)
    {
      $usuario = User::findOrFail($id);
      $usuario->delete();
      return back()->with('success','¡Usuario eliminado!');
    }
}
