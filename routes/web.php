<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\usercontroller;

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
// Route::get('create', function () {
//     return view('create');
// });
Route::get('user/create',[usercontroller::class,'create']);
Route::post('user/store',[usercontroller::class,'store']);
Route::post('search',[usercontroller::class,'search']);

