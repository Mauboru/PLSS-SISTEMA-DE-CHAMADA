<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chamado extends Model {
    use HasFactory;

    protected $table = 'plss_chamados'; 
    protected $fillable = ['titulo', 'categoria_id', 'descricao', 'prazo_solucao', 'situacao_id', 'created_at', 'situacao', 'data_solucao'];
    protected $casts = [
        'created_at' => 'datetime',
        'prazo_solucao' => 'datetime',
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function situacao() {
        return $this->belongsTo(Situacao::class);
    }
}
