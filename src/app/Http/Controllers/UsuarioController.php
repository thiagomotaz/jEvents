<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function create(Request $request)
    {
        $usuario = new Usuario;
        $usuario->nomeUsuario = $request->nome;
        $usuario->emailUsuario = $request->email;
        $usuario->loginUsuario = $request->login;
        // $usuario->senhaUsuario = Hash::make($request->senha);
        $usuario->senhaUsuario = $request->senha;
        $usuario->api_key = '';
        $usuario->save();
        return response()->json($usuario);
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'acesso' => 'required',
            'senha' => 'required'
        ]);
        $acesso = request()->input('acesso');
        $tipoAcesso = filter_var($acesso, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if ($tipoAcesso == 'email') { //verificação de tipo de acesso (login ou email)
            $usuario = Usuario::where('emailUsuario', $request->input('acesso'))->first();
        } else {
            $usuario = Usuario::where('loginUsuario', $request->input('acesso'))->first();
        }

        // if (Hash::check($request->input('senha'), $usuario->senhaUsuario)) {
        if ($request->input('senha') == $usuario->senhaUsuario) {
            $apikey = base64_encode(Str::random(40));
            Usuario::where(($tipoAcesso.'Usuario'), $request->input('acesso'))->update(['api_key' => "$apikey"]);;
            return response()->json(['status' => 'success', 'api_key' => $apikey]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}
