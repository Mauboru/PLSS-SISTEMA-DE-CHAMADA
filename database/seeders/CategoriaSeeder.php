<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder {
    public function run() {
        $categorias = [
            ['nome' => 'Suporte'],
            ['nome' => 'Infraestrutura'],
            ['nome' => 'Software'],
            ['nome' => 'Hardware'],
            ['nome' => 'Redes'],
            ['nome' => 'Outros'],
        ];

        DB::table('plss_categorias')->insert($categorias);
    }
}
