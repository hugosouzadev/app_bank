<?php

use App\Domain\Entities\Carteira;
use App\Domain\Entities\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $tipoUsuario =  random_int(1, 2);

            $documento = ($tipoUsuario === 1) ?
                sprintf(
                    '%s.%s.%s-%s',
                    str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT),
                    rand(100, 999),
                    rand(100, 999),
                    rand(10, 99)
                )
                :
                $documento = sprintf(
                    '%s.%s.%s/000%s-%s',
                    str_pad(rand(1, 99), 2, "0", STR_PAD_LEFT),
                    rand(100, 999),
                    rand(100, 999),
                    rand(1, 9),
                    rand(10, 99),
                );

            $usuario = Usuario::create([
                'nomeCompleto' => "usuario$i bank",
                'documento' => $documento,
                'email' => "usuario$i@bank.com.br",
                'usuarioTipo_id' => $tipoUsuario,
                'senha' => '123321'
            ]);

            $usuario->save();

            Carteira::create([
                'saldo' => random_int(500, 1000),
                'usuarios_id' => $usuario->id
            ])->save();
        }
    }
}
