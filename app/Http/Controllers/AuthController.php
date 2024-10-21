<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {

        $session_start_usuario = session()->get('session_start_usuario');
        if(Auth::check() && $session_start_usuario) :
            // Si está logueado le mostramos la vista de logueados
	        return view('admin.index');
        else:
          return view('login.index');
        endif;

    }

    public function login_provider(Request $request) {

        $display_name = $request->name;
        $data_session = '';
        $session_start_usuario = session()->get('session_start_usuario');

        // Comprobamos que el name y la contraseña han sido introducidos
	    $request->validate([
	        'name' => 'required',
	        'password' => 'required',
	    ]);
	
	    // Almacenamos las credenciales de name y contraseña
	    $credentials = $request->only('name', 'password');
	
	    // Si el usuario existe lo logueamos y lo llevamos a la vista de "logados" con un mensaje
	    if (Auth::attempt($credentials)) {
            
            if(!$session_start_usuario) :
                 //creamos su sesion si no existe una activa o ya existenten
               $session_start_usuario=[
                $data_session => [
                    "name" => $display_name
                ]
              ];

              session()->put('session_start_usuario', $session_start_usuario);
            endif;

	        return redirect()->intended('admin/dashboard')
	            ->with('success','¡Haz iniciado sesión correctamente!');
	    }
	
	    // Si el usuario no existe devolvemos al usuario al formulario de login con un mensaje de error
        return back()->with('errors_login','Uno o más campos no son correctos, por favor intentalo de nuevo.');

    }

    public function ingreso_exitoso() {
            $session_start_usuario = session()->get('session_start_usuario');
            if(Auth::check() && $session_start_usuario) :
              // Si está logado le mostramos la vista de logados
	            return view('admin.index');
            endif;
    }


    public function session_destroy_logout(Request $request) {
        $session_start_usuario = session()->get('session_start_usuario');
        // Si está logado y existe la sesion activa, entonces destruimos la session   
        session()->forget('session_start_usuario');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
     
        return redirect('/login-acceso')->with('success','¡Haz cerrado la sesión correctamente!');
    }

}
