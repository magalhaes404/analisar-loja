<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EmpresaController;
class HomeController extends Controller {

    public function index(Request $request) {
        $controller = new ProdutoController();
        $produtos = $controller->all($request);
        return view('welcome', ['produtos' => $produtos]);
    }

    public function produto($uuid) {
        $controller = new ProdutoController();
        $produto = $controller->get($uuid);
        return view('produto', ['produto' => $produto]);
    }
    
    public function empresas(Request $request)
    {
        $controller = new EmpresaController();
        $empresas = $controller->all($request);
        return view('empresa.all',['empresas' => $empresas]);
    }
    
    public function empresa_detalhes($uuid)
    {
        $controller = new EmpresaController();
        $empresa = $controller->get($uuid);
        return view('empresa.detalhes',['empresa' => $empresa]);
    }

}
