<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Evento;
use Auth;

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
        $usuario = Auth::user()->todo()->get();
        return response()->json(['status' => 'success','result' => $usuario]);
    }

    //  public function index()
    // {
    //     $usuario = Usuario::all();
    //     return response()->json($usuario);
    // }
}
