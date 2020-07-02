<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }

    public function create(Request $request)
    {
        $usuario = new Usuario;
        $usuario->nomeUsuario = $request->nome;
        $usuario->emailUsuario = $request->email;
        $usuario->loginUsuario = $request->login;
        $usuario->senhaUsuario = $request->senha;
        $usuario->save();
        return response()->json($usuario);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
     { 
        $usuario= Usuario::find($id);
        
        $usuario->nomeUsuario = $request->input('nome');
        $usuario->emailUsuario = $request->input('email');
        $usuario->loginUsuario = $request->input('login');
        $usuario->senhaUsuario = $request->input('senha');
        $usuario->save();
        return response()->json($usuario);
     }

     public function destroy($id)
     {
        $usuario = Usuario::find($id);
        $usuario->delete();
        return response()->json('usuario removido com sucesso');
     }
}
