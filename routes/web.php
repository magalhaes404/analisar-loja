<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ComprarController;
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

Route::get('/',[HomeController::class,'index'])->name('default');

Route::group(['prefix'=>'Produto'],function(){
    Route::get('/{uuid}',[HomeController::class,'produto'])->name('produto');
});

Route::group(['prefix'=>'Empresas'],function(){
    Route::get('/',[HomeController::class,'empresas'])->name('empresa');
    Route::get('/{uuid}',[HomeController::class,'empresa_detalhes'])->name('empresa_detalhes');
});

Route::group(['prefix'=>'Comprar'],function(){
    Route::post('/',[ComprarController::class,'comprar']);
});