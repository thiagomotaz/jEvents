<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Evento;
use App\Usuario;
use Auth;
use phpDocumentor\Reflection\Types\Object_;

class EventoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //pega os eventos do usuário autorizado(já ordenados por data)
        $eventosLogado = Auth::user()->eventos()->get(); 
        $idLogado =  Auth::user()['idUsuario'];
        $eventos = Evento::where('idUsuario_Responsavel', '<>', $idLogado)->orderBy('dataEvento', 'ASC')->get(); //pega o resto dos eventos
        return response()->json(['status' => 'success', 'result' => $eventosLogado, $eventos]);
    }

    //Adiciona novo evento para usuários autenticados (Authorization)
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'observacoes' => 'required',
            'idUsuario' => 'required',
            'idUsuario_Responsavel' => 'required'
        ]);

        if (Auth::user()) {
            $evento = new Evento;
            $evento->descricaoEvento = $request->input('descricao');
            $evento->dataEvento = $request->input('data');
            $evento->horaEvento = $request->input('hora');
            $evento->observacoesEvento = $request->input('observacoes');
            $evento->idUsuario = $request->input('idUsuario');
            $evento->idUsuario_Responsavel = $request->input('idUsuario_Responsavel');
            $evento->save();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }

    //consulta de eventos de um usuário
    public function show($id)
     {
        $eventos = Evento::all()->where('idUsuario_Responsavel', '=', $id);
        return response()->json($eventos);
     }


    //  public function index()
    // {
    //     $usuario = Usuario::all();
    //     return response()->json($usuario);
    // }
}
