<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('tipo_usuario')->insert([
            'nome' => "Administrador",
            'status' => true
        ]);
        DB::table('estado')->insert([
            'nome' => "Pará",
            'status' => true
        ]);
        DB::table('cidade')->insert([
            'nome' => "Santarém",
            'estadoId' => 1,
            'status' => true
        ]);
        DB::table('unidade')->insert([
            'nome' => "Unidade 2",
            'rua' => "Teste",
            'numero' => "110-b",
            'bairro' => "conquista",
            'cep' => "68035-490",
            'cidadeId' => 1,
            'status' => true
        ]);

        DB::table('users')->insert([
            'name' => "Edinelson Junior",
            'email' => "edinelsonjr.stm@gmail.com",
            'password' => bcrypt('123456'),
            'unidadeId' => 1,
            'tipoUsuarioId' => 1,
        ]);
    }
}
