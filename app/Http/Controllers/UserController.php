<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller {

    public function new(Request $request) {
        $validor = validator($request->all(), [
            'nome' => 'required|min:20|max:150',
            'cpf' => 'required|min:11|max:14|unique:users',
            'email' => 'required|min:10|max:150|unique:users',
            'senha1' => 'required|min:6|max:8|same:senha2',
            'senha2' => 'required|min:6|max:8|same:senha1'
        ]);
        if ($validor->fails()) {
            return back()->with('erro', erros_text($validor->errors()));
        } else {
            $cliente = new User();
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->cpf = $request->cpf;
            $cliente->senha = Hash::make($request->senha1);
            if ($cliente->save()) {
                return back()->with('sucesso', __('user.ok.salvo'));
            } else {
                return back()->with('erro', __('user.erro.salvo'));
            }
        }
    }

    public function update(Request $request) {
        $cliente = Auth::user();
        $validor = validator($request->all(), [
            'nome' => 'required|min:20|max:150',
        ]);
        if ($validor->fails()) {
            return back()->with('erro', $validor->errors());
        } else {
            $cliente->nome = $request->nome;
            if ($cliente->save()) {
                return back()->with('sucesso', __('user.ok.update'));
            } else {
                return back()->with('erro', __('user.erro.update'));
            }
        }
    }

}
