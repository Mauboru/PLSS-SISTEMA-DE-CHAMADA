<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

DB::table('plss_categorias')->insert([
    ['nome' => 'Pendente', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ['nome' => 'Resolvido', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
]);
