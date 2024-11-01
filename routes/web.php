<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use App\Models\Compra;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rutas del login
//Route::get('/', [AuthController::class, 'index'])->name('home');
Route::get('/login-acceso', [AuthController::class, 'index'])->name('custom_login');
Route::post('/logout', [AuthController::class, 'session_destroy_logout'])->name('cerrar_sesion');
Route::post('/success-login', [AuthController::class, 'login_provider'])->name('login_provider');




Route::prefix('admin')->middleware('auth')->group(function() {


Route::get('dashboard', [AuthController::class, 'ingreso_exitoso'])->name('logueado');
    //rutas admin usuarios
Route::get('usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('usuarios/create', [UserController::class, 'create'])->name('vista_create_usuario');
Route::get('usuarios/editar_usuario/{id}', [UserController::class, 'edit'])->name('vista_editar_usuario');
Route::post('/new-user', [UserController::class, 'store'])->name('new_user');
Route::put('usuarios/update-user/{id}', [UserController::class, 'update'])->name('actualizar_usuario');
Route::delete('usuarios/{id}', [UserController::class, 'destroy'])->name('eliminar_usuario');

 //rutas admin categorias
 Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index');
 Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
 Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store');
 Route::get('categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
 Route::put('categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
 Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

 //rutas admin productos
 Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
 Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
 Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');
 Route::get('productos/recuperar-producto/{id}', [ProductoController::class, 'get_Producto'])->name('productos.get_Producto');
 Route::put('productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
 Route::delete('productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

 //rutas admin proveedores
 Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedor.index');
 Route::get('proveedores/create', [ProveedorController::class, 'create'])->name('proveedor.create');
 Route::post('proveedores', [ProveedorController::class, 'store'])->name('proveedor.store');
 Route::get('proveedores/{id}', [ProveedorController::class, 'edit'])->name('proveedor.edit');
 Route::put('proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedor.update');
 Route::delete('proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedor.destroy');

//rutas admin compras
Route::get('compras', [CompraController::class, 'index'])->name('compras.index');
Route::get('compras/create', [CompraController::class, 'create'])->name('compras.create');
Route::post('compras/add-item/{id}', [CompraController::class, 'agregar_carro_compras'])->name('compras.agregar_carro_compras');
Route::post('compras', [CompraController::class, 'store'])->name('compras.store');


});


