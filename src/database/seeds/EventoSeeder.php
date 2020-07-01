<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evento')->insert(
            [
                'descricaoEvento' => 'Encontro de motociclistas de São Pedro da Aldeia',
                'dataEvento' => '2020-07-07',
                'horaEvento' => '20:00:00',
                'observacoesEvento' => 'Venha de moto e traga sua família (?)',
                'idUsuario' => 1,
                'idUsuario_Responsavel' => 2
            ],
        );
        DB::table('evento')->insert(

            [
                'descricaoEvento' => 'Torneio de Muai Thay',
                'dataEvento' => '2020-07-10',
                'horaEvento' => '15:00:00',
                'observacoesEvento' => 'Faça sua inscricao pelo site www.torneiodemuaithay.com',
                'idUsuario' => 1,
                'idUsuario_Responsavel' => 1
            ]
        );
    }
}
