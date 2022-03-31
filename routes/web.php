<?php

use  Illuminate\Support\Facades\Route;
use  App\Http\Controllers\usercontroller;
use  App\Http\Controllers\BlogController;


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


Route::get('user/create',[usercontroller::class,'create']);
Route::post('user/store',[usercontroller::class,'store']);

Route::middleware(['userCheck'])->group(function(){

Route::get('user/',[usercontroller::class,'index']);
Route::get('user/Remove/{id}',[usercontroller::class,'delete']);
Route::get('user/Edit/{id}',[usercontroller::class,'edit']);
Route::post('user/Update/{id}',[usercontroller::class,'update']);
Route::get('/user/logOut',[usercontroller::class,'logOut']);
Route::resource('Blog',BlogController::class);
});
Route::middleware(['expireDate'])->group(function(){

        Route::get('Blog/{id}/edit',[BlogController::class,'edit']);
        Route::put('Blog/{id}',[BlogController::class,'update']);
        Route::delete('Blog/{id}',[BlogController::class,'delete']);
});

# Auth .....
Route::get('/Login',[usercontroller::class,'login'])->name('login');
Route::post('/DoLogin',[usercontroller::class,'doLogin']);
