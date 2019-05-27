<?php

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
})->name('inicio');

Auth::routes();
Route::get('/register/verify/{code}', 'Auth\RegisterController@verify');

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de producto
Route::get('/productos', 'ProductoController@index')->name('producto.index');
Route::get('/productos/mostrar', 'ProductoController@show')->name('producto.show');
Route::get('/producto/crear', 'ProductoController@create')->name('producto.create');
Route::post('/productos/crear', 'ProductoController@store')->name('producto.store');
Route::get('/productos/editar/{id}', 'ProductoController@edit')->name('producto.edit');
Route::put('/productos/editar/{id}', 'ProductoController@update')->name('producto.update');
Route::post('/productos/eliminar', 'ProductoController@destroy')->name('producto.destroy');

//Rutas de empleado
Route::get('/empleados', 'EmpleadoController@index')->name('empleado.index');
Route::get('/empleados/mostrar', 'EmpleadoController@show')->name('empleado.show');
Route::get('/empleados/crear', 'EmpleadoController@create')->name('empleado.create');
Route::post('/empleados/crear', 'EmpleadoController@store')->name('empleado.store');
Route::get('/empleados/editar/{id}', 'EmpleadoController@edit')->name('empleado.edit');
Route::put('/empleados/editar/{id}', 'EmpleadoController@update')->name('empleado.update');
Route::post('/empleados/eliminar', 'EmpleadoController@destroy')->name('empleado.destroy');

//Rutas de servicio
Route::get('/servicios', 'ServicioController@index')->name('servicio.index');
Route::get('/servicios/mostrar', 'ServicioController@show')->name('servicio.show');
Route::get('/servicios/crear', 'ServicioController@create')->name('servicio.create');
Route::post('/servicios/crear', 'ServicioController@store')->name('servicio.store');
Route::get('/servicios/{id}/agregar/productos', 'ServicioController@productos')->name('servicio.productos');
Route::post('/servicios/{id}/agregar/productos', 'ServicioController@agregarProductos')->name('servicio.agregarProd');
Route::get('/servicios/editar/{id}', 'ServicioController@edit')->name('servicio.edit');
Route::put('/servicios/editar/{id}', 'ServicioController@update')->name('servicio.update');
Route::post('/servicios/eliminar', 'ServicioController@destroy')->name('servicio.destroy');

//Rutas de cita
Route::get('/citas', 'CitaController@index')->name('cita.index');
Route::get('/citas/mostrar', 'CitaController@show')->name('cita.show');
Route::get('/citas/crear', 'CitaController@create')->name('cita.create');
Route::post('/citas/crear', 'CitaController@store')->name('cita.store');
Route::get('/citas/editar/{id}', 'CitaController@edit')->name('cita.edit');
Route::put('/citas/editar/{id}', 'CitaController@update')->name('cita.update');
Route::post('/citas/eliminar', 'CitaController@destroy')->name('cita.destroy');


