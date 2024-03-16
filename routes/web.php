<?php

use App\Http\Controllers\ControllerPrikazy;
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
      return view('prikazy');
  });
Route::get('/hello', function(){
    return "hello";
});
Route::get('/prikazy', [ControllerPrikazy::class, 'Select_streams_b']);
Route::post('/prikazy', function () {
    //return UserController::post();
});
