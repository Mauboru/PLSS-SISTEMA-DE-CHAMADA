<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacaoSeeder extends Seeder {

    public function run() {
        $situacoes = [
            ['id' => 1, 'nome' => 'Novo'],
            ['id' => 2, 'nome' => 'Pendente'],
            ['id' => 3, 'nome' => 'Resolvido'],
        ];
        DB::table('plss_situacoes')->insert($situacoes);
    }
}
