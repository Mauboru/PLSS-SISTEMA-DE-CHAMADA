<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model {
    use HasFactory;

    protected $table = 'plss_chamados'; 
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'categoria_id',
        'descricao',
        'prazo_solucao',
        'situacao_id',
        'data_criacao',
        'data_solucao'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    // public function situacao() {
    //     return $this->belongsTo(Situacao::class);
    // }
}