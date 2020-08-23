<?php

use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nome' => "comum",
            ], [
                'nome' => "lojista"
            ]
        ];
        DB::table('usuarioTipo')->insert($data);
    }
}
