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
        $this->middleware('auth', ['except' => 'show']); //ativa o auth com restrição de rota
    }

    public function index(Request $request)
    {

        //pega os eventos do usuário autenticado, depois o resto deles(diferente do id do usuario autenticado), 
        //aplica um dos filtros e faz merge nos arrays no final, mostrando os eventos do usuário no topo
        $idLogado =  Auth::user()['idUsuario'];
        $eventosLogado = null;
        $eventos = null;
        $descricao = $request->get('descricao');
        if ($request->has('descricao')) {
            $eventos = Evento::where('idUsuario_Responsavel', '<>', $idLogado)
                ->where('descricaoEvento', 'LIKE', "%$descricao%")
                ->orderBy('dataEvento', 'ASC')
                ->get();
            $eventosLogado = Auth::user()->eventos()->where('descricaoEvento', 'LIKE', "%$descricao%")->get();
        } else if ($request->has('responsavel')) {
            $eventos = Evento::where('idUsuario_Responsavel', '<>', $idLogado)
                ->where('idUsuario_Responsavel', '=', $request->get('responsavel'))
                ->orderBy('dataEvento', 'ASC')
                ->get();
            $eventosLogado = Auth::user()->eventos()->where('idUsuario_Responsavel', '=', $request->get('responsavel'))->get();
        } else {
            $eventos = Evento::where('idUsuario_Responsavel', '<>', $idLogado)->orderBy('dataEvento', 'ASC')->get();
            $eventosLogado = Auth::user()->eventos()->get();
        }
        $merged = $eventosLogado->merge($eventos);
        return response()->json($merged);
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
            return response()->json(['status' => 'Evento cadastrado com sucesso!']);
        } else {
            return response()->json(['status' => 'Falha ao cadastrar evento!']);
        }
    }

    //consulta de eventos de um usuário
    public function show($id)
    {
        $eventos = Evento::all()->where('idUsuario_Responsavel', '=', $id);
        return response()->json($eventos);
    }
}
