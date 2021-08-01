<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Str;

class EmpresaController extends Controller {

    public function all(Request $request) {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        $empresas = Empresa::paginate($limit);
        if (count($empresas) == 0) {
            abort(403);
        } else {
            return $empresas;
        }
    }

    public function new(Request $request) {
        $validor = validator($request->all(), [
            'cep' => 'required|min:8|max:9',
            'nome' => 'required|min:20|max:150',
            'razao_social' => 'required|min:20|max:150',
            'cnpj' => 'required|min:14|max:18|unique:empresas',
            'numero' => 'required|numeric',
            'telefone' => 'required|min:12|max:15',
            'email' => 'required|min:10|max:150|unique:empresas'
        ]);
        if ($validor->fails()) {
            return response()->json(['Status' => 'erro', 'Mensagem' => $validor->errors()]);
        } else {
            $cep = str_replace('-', '', $request->cep);
            $endereco = $this->converterCep($cep);
            if ($endereco != false) {
                $empresa = new Empresa();
                $empresa->nome = $request->nome;
                $empresa->razao_social = $request->razao_social;
                $empresa->cnpj = $request->cnpj;
                $empresa->cep = $cep;
                $empresa->rua = $endereco->logradouro;
                $empresa->numero = $request->numero;
                $empresa->bairro = $endereco->bairro;
                $empresa->cidade = $endereco->localidade;
                $empresa->estado = $endereco->uf;
                $empresa->complemento = $endereco->complemento ?? null;
                $empresa->telefone = $this->converterTelefone($request->telefone);
                $empresa->email = $request->email;
                $empresa->uuid = Str::uuid();
                if ($empresa->save()) {
                    return response()->json(['Status' => 'ok', 'Mensagem' => __('empresa.ok.salvo')]);
                } else {
                    return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.erro.salvar')]);
                }
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.erro.cep')]);
            }
        }
    }

    public function get($uuid) {
        $empresa = Empresa::where('uuid', '=', $uuid)->first();
        if (empty($empresa) == false) {
            return $empresa;
        }
        abort(404);
    }

    public function update($uuid, Request $request) {
        $validor = validator($request->all(), [
            'cep' => 'required|min:8|max:9',
            'nome' => 'required|min:20|max:150',
            'razao_social' => 'required|min:20|max:150',
            'cnpj' => 'required|min:14|max:18|unique:empresas',
            'numero' => 'required|numeric',
            'telefone' => 'required|min:12|max:15',
            'email' => 'required|min:10|max:150|unique:empresas'
        ]);
        if ($validor->fails()) {
            return response()->json(['Status' => 'erro', 'Mensagem' => $validor->errors()]);
        } else {
            $empresa = Empresa::where('uuid', '=', $uuid)->first();
            if (empty($empresa) == false) {
                $cep = str_replace('-', '', $request->cep);
                $endereco = $this->converterCep($cep);
                if ($endereco != false) {
                    $empresa->nome = $request->nome;
                    $empresa->razao_social = $request->razao_social;
                    $empresa->cnpj = $request->cnpj;
                    $empresa->cep = $cep;
                    $empresa->rua = $endereco->logradouro;
                    $empresa->numero = $request->numero;
                    $empresa->bairro = $endereco->bairro;
                    $empresa->cidade = $endereco->localidade;
                    $empresa->estado = $endereco->uf;
                    $empresa->complemento = $endereco->complemento ?? null;
                    $empresa->telefone = $this->converterTelefone($request->telefone);
                    $empresa->email = $request->email;
                    $empresa->uuid = Str::uuid();
                    if ($empresa->save()) {
                        return response()->json(['Status' => 'ok', 'Mensagem' => __('empresa.ok.salvo')]);
                    } else {
                        return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.erro.salvar')]);
                    }
                } else {
                    return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.erro.cep')]);
                }
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => __('empresa.vazio')]);
            }
        }
    }

    public function converterCep($cep) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://viacep.com.br/ws/' . $cep . '/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = json_decode(curl_exec($curl));
        if (isset($response->erro) == false) {
            return $response;
        } else {
            return false;
        }
    }

    public function converterTelefone($telefone) {
        return str_replace('-', '', str_replace(' ', '', str_replace(')', '', str_replace('(', '', $telefone))));
    }

}
