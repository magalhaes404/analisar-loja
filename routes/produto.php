<?php

use App\Http\Controllers\ProdutoController;

Route::post('/Nova', [ProdutoController::class, 'new']);
Route::get('/{uiid}', [ProdutoController::class, 'get']);
Route::get('/', [ProdutoController::class, 'all']);
?>
