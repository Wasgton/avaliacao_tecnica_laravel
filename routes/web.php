<?php

use App\BirthPlaces;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->name('admin.')->group(function(){

    Route::resource('clientes','ClientController')->names('clients')->parameters(['clientes'=>'clients']);
    Route::resource('estados','BirthPlacesController')->names('birthPlaces')->parameters(['estados'=>'birthPlaces']);
    Route::resource('usuarios','UserController')->names('users')->parameters(['usuario'=>'user']);

});
