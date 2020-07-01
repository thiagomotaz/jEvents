<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert(
            [
                'nomeUsuario' => 'José Silva Mota',
                'emailUsuario' => 'josesilva@gmail.com',
                'loginUsuario' => 'josesilvaz',
                'senhaUsuario' => '123jose#$',
            ]
        );
        DB::table('usuario')->insert(
            [
                'nomeUsuario' => 'Thiago Marques',
                'emailUsuario' => 'thiagom@gmail.com',
                'loginUsuario' => 'marquesthiago',
                'senhaUsuario' => 'thiago87965',
            ],
        );
    }
}
