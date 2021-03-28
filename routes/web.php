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

    Route::resource('cliente','ClientController')->names('clients')->parameters(['cliente'=>'clients']);
    Route::resource('estado','BirthPlacesController')->names('birthPlaces')->parameters(['estado'=>'birthPlaces']);
    Route::resource('usuario','UserController')->names('users')->parameters(['usuario'=>'user']);

});
