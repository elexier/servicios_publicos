<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Route::resource('/servicios', 'ServiciosPublicosController');


Route::get('/', function () {


    //$tipofactura= \App\Tipofactura::findOrFail(1);

    ///return  $tipofactura->servicios;

    //$servicio= \App\Servicio::findOrfail(1);

    //return $servicio->tipofacturas;
    //return $servicio;


    return view('welcome');
});

Auth::routes();

//mis rutas

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/servicios/index', 'ServiciosPublicosController@index')->name('servicios.index');

//Route::get('/servicios/{id}/edit', 'ServiciosPublicosController@edit')->name('servicios.edit');

//Route::get('/servicios/create', 'ServiciosPublicosController@create')->name('servicios.create');

//Route::patch('/servicios/{id}', 'ServiciosPublicosController@update')->name('servicios.update');

//Route::post('/servicios', 'ServiciosPublicosController@store')->name('servicios.store');

//Route::delete('/servicios/{id}', 'ServiciosPublicosController@destroy')->name('servicios.destroy');

//RUTAS PARA SERVICIO
Route::get('/servicios/index', 'ServicioController@index')->name('servicios.index');

Route::get('/servicios/{id}/edit', 'ServicioController@edit')->name('servicios.edit');

Route::get('/servicios/create', 'ServicioController@create')->name('servicios.create');

Route::patch('/servicios/{id}', 'ServicioController@update')->name('servicios.update');

Route::post('/servicios', 'ServicioController@store')->name('servicios.store');

Route::delete('/servicios/{id}', 'ServicioController@destroy')->name('servicios.destroy');


//RUTAS PARA PROVEEDOR
Route::get('/proveedores/index', 'ProveedorController@index')->name('proveedores.index');

Route::get('/proveedores/{id}/edit', 'ProveedorController@edit')->name('proveedores.edit');

Route::get('/proveedores/create', 'ProveedorController@create')->name('proveedores.create');

Route::patch('/proveedores/{id}', 'ProveedorController@update')->name('proveedores.update');

Route::post('/proveedores', 'ProveedorController@store')->name('proveedores.store');

Route::delete('/proveedores/{id}', 'ProveedorController@destroy')->name('proveedores.destroy');





