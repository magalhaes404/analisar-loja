<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\UploadController;
use App\Models\Produto;
use App\Models\Empresa;
use Illuminate\Support\Str;

class ProdutoController extends Controller {

    public function new(Request $request) {
        $validor = validator($request->all(), [
            'nome' => 'required|min:20|max:150|unique:produtos',
            'descricao' => 'required|min:20|max:255',
            'foto' => 'required|file|max:520',
            'preco' => 'required|min:1',
            'uiid' => 'required|min:10|max:255',
            'estoque' => 'required|numeric|min:1'
        ]);
        if ($validor->fails()) {
            return response()->json(['Status' => 'erro', 'Mensagem' => $validor->errors()]);
        } else {
            $empresa = Empresa::where('uuid', '=', $request->uiid)->first();
            if (empty($empresa) == false) {
                $arquivo = new UploadController();
                $produto = new Produto();
                $produto->nome = $request->nome;
                $produto->descricao = $request->descricao;
                $produto->foto = $arquivo->store($request->foto);
                $produto->empresa = $empresa->id;
                $produto->qtd_estoque = $request->estoque;
                $produto->preco = $request->preco;
                $produto->uuid = Str::uuid();
                if ($produto->save()) {
                    return response()->json(['Status' => 'ok', 'Mensagem' => __('produto.ok.salvo')]);
                } else {
                    return response()->json(['Status' => 'erro', 'Mensagem' => __('produto.erro.salvo')]);
                }
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => 'Id empresa invalido']);
            }
        }
    }

    public function get($uiid) {
        $produto = Produto::where('uuid', '=', $uiid)->first();
        if (empty($produto)) {
            return response()->json(['Status' => 'erro', 'Mensagem' => __('produto.erro.existe')]);
        } else {
            if ($produto->autor->isAtivo) {
                $lista_produto = $this->retorne_produto($produto);
                return response()->json(['Status' => 'ok', 'Produto' => $lista_produto]);
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.erro.desativado')]);
            }
        }
    }

    public function retorne_produto($produto) {
        return array(
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => $produto->preco,
            'fornecedor' => $produto->autor->nome,
            'estoque' => $produto->qtd_estoque,
        );
    }

    public function all(Request $request) {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        $produtos = Produto::paginate($limit);
        if (count($produtos) == 0) {
            return response()->json(['Status' => 'ok', 'Mensagem' => __('produto.vazio')]);
        } else {
            $lista_produtos = array();
            foreach ($produtos as $produto) {
                if ($produto->autor->isAtivo) {
                    array_push($lista_produtos, $this->retorne_produto($produto));
                }
            }
            return response()->json(['Status' => 'ok', 'Produtos' => $lista_produtos]);
        }
    }

    public function listar_empresa($uiid) {
        $empresa = Empresa::where('uuid', '=', $uiid)->first();
        if (empty($empresa)) {
            return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.vazio')]);
        } else {
            $lista_produtos = array();
            $produtos = $empresa->produtos;
            if (count($produtos) == 0) {
                return response()->json(['Status' => 'ok', 'Mensagem' => __('produto.vazio')]);
            } else {
                $lista_produtos = array();
                foreach ($produtos as $produto) {
                    array_push($lista_produtos, $this->retorne_produto($produto));
                }
                return response()->json(['Status' => 'ok', 'Produtos' => $lista_produtos]);
            }
            foreach ($produtos as $produto) {
                array_push($lista_produtos, $this->retorne_produto($produto));
            }
            return response()->json(['Status' => 'ok', 'Produtos' => $lista_produtos]);
        }
    }

}
