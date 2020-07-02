<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Usuario extends Model implements Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    use AuthenticableTrait;

    protected $fillable = [
        'nomeUsuario', 'emailUsuario', 'loginUsuario', 'api_key'
    ];
    protected $hidden = [
        'senhaUsuario'
    ];

  
    public function todo()
    {
        return $this->hasMany('App\Evento','idUsuario');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
}
