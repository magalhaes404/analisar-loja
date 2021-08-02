<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EmpresaController;
use App\Models\Produto;
use App\Models\Transacao;
use Illuminate\Support\Str;

class HomeController extends Controller {

    public function index(Request $request) {
        //echo "Hash => ".Hash::make('123456');
        //$2y$10$F3TIcd5d9OKrxPEQ7/8DC.pth1zVKi5ZdM3j8Lqhh8Mq5A0L1CSca => 123456
        $controller = new ProdutoController();
        $produtos = $controller->all($request);
        return view('welcome', ['produtos' => $produtos]);
    }

    public function login(Request $request) {
        return view('login');
    }

    public function cadastro(Request $request) {
        return view('cadastro');
    }

    public function produto($uuid) {
        $controller = new ProdutoController();
        $produto = $controller->get($uuid);
        return view('produto', ['produto' => $produto]);
    }

    public function empresas(Request $request) {
        $controller = new EmpresaController();
        $empresas = $controller->all($request);
        return view('empresa.all', ['empresas' => $empresas]);
    }

    public function empresa_detalhes($uuid) {
        $controller = new EmpresaController();
        $empresa = $controller->get($uuid);
        return view('empresa.detalhes', ['empresa' => $empresa]);
    }

    public function comprar(Request $request) {
        $user = auth()->user();
        $produto = Produto::where('uuid', '=', $request->produto)->first();
        if (empty($produto) == false) {
            if ($user->saldo > ($produto->preco * $request->quantity)) {
                $transacao = new Transacao();
                $transacao->id_user = $user->id;
                $transacao->id_produto = $produto->id;
                $transacao->valor_unitario = $produto->preco;
                $transacao->valor_total = $produto->preco * $request->quantity;
                $transacao->quantidade = $request->quantity;
                $transacao->status = 1;
                $transacao->uuid = Str::uuid();
                $transacao->save();
                $user->saldo = $user->saldo - ($produto->preco * $request->quantity);
                $produto->qtd_estoque = $produto->qtd_estoque - $request->quantity;
                $user->save();
                $produto->save();
                return redirect()->route('compra-ok');
            } else {
                return redirect()->route('compra-falha');
            }
        }
    }

    public function comprar_ok() {
        return view('compra.sucesso');
    }

    public function comprar_falha() {
        return view('compra.falha');
    }

    public function perfil_usuario() {
        $user = auth()->user();
        return view('user.perfil', ['usuario' => $user]);
    }

    public function vendas() {
        $vendas = Transacao::where('id_user', '=', auth()->user()->id)->get();
        return view('user.venda', ['vendas' => $vendas]);
    }

}
