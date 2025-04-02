<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('plss_chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->foreignId('categoria_id')->constrained('plss_categorias')->onDelete('cascade');
            $table->text('descricao');
            $table->date('prazo_solucao');
            $table->foreignId('situacao_id')->default(1)->constrained('plss_situacoes')->onDelete('cascade');
            $table->timestamp('data_criacao')->useCurrent();
            $table->timestamp('data_solucao')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('plss_chamados');
    }
};
