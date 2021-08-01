<?php
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProdutoController;

Route::get('/',[EmpresaController::class,'all']);
Route::get('/Produtos/{uuid}',[ProdutoController::class,'listar_empresa']);
Route::post('/Nova',[EmpresaController::class,'new']);

?>
