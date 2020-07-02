<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'idEvento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricaoEvento', 'dataEvento', 'horaEvento', 'observacoesEvento', 'idUsuario', 'idUsuario_Responsavel'
    ];
}
?>