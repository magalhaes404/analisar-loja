<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {

    public function new(Request $request) {
        $validor = validator($request->all(), [
            'nome' => 'required|min:20|max:150',
            'cpf' => 'required|min:11|max:14|unique:user',
            'email' => 'required|min:10|max:150|unique:user',
            'senha1' => 'required|min:6|max:8|same:senha2',
            'senha2' => 'required|min:6|max:8|same:senha1'
        ]);
        if ($validor->fails()) {
            return response()->json(['Status' => 'erro', 'Mensagem' => $validor->errors()]);
        } else {
            $cliente = new User();
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->cpf = $request->cpf;
            $cliente->senha = Hash::mask($request->senha1);
            if ($cliente->save()) {
                return response()->json(['Status' => 'ok', 'Mensagem' => __('user.ok.confirmar')]);
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => __('user.erro.salvar')]);
            }
        }
    }

    public function update(Request $request) {
        $cliente = Auth::user();
        $validor = validator($request->all(), [
            'nome' => 'required|min:20|max:150',
        ]);
        if ($validor->fails()) {
            return response()->json(['Status' => 'erro', 'Mensagem' => $validor->errors()]);
        } else {
            $cliente->nome = $request->nome;
            if ($cliente->save()) {
                return response()->json(['Status' => 'ok', 'Mensagem' => __('user.ok.update')]);
            } else {
                return response()->json(['Status' => 'erro', 'Mensagem' => __('user.erro.update')]);
            }
        }
    }

    
}
