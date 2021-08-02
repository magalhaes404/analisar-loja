<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ComprarController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('default');

Route::get('/Login', [HomeController::class, 'login'])->name('login');
Route::get('/Cadastro', [HomeController::class, 'cadastro'])->name('cadastro');

Route::group(['prefix' => 'Produto'], function() {
    Route::get('/{uuid}', [HomeController::class, 'produto'])->name('produto');
});

Route::group(['prefix' => 'Empresas'], function() {
    Route::get('/', [HomeController::class, 'empresas'])->name('empresa');
    Route::get('/{uuid}', [HomeController::class, 'empresa_detalhes'])->name('empresa_detalhes');
});

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'Comprar'], function() {
        Route::post('/', [HomeController::class, 'comprar'])->name('comprar');
        Route::get('/Sucesso', [HomeController::class, 'comprar_ok'])->name('compra-ok');
    });
    Route::group(['prefix'=>'Perfil'], function() {
        Route::get('/',[HomeController::class,'perfil_usuario'])->name('usuario_perfil');
        Route::get('/Vendas',[HomeController::class,'vendas'])->name('usuario_vendas');
        Route::post('/Editar', [UserController::class, 'update'])->name('usuario_editar');
        Route::get('/Sair', [AuthController::class, 'sair'])->name('usuario_sair');
    });
});
Route::group(['prefix' => 'Auth'], function() {
    Route::post('/', [AuthController::class, 'login'])->name('logar');
    Route::post('/Cadastro', [UserController::class, 'new'])->name('cadastrar');
});
