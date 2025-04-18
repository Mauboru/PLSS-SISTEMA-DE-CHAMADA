<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    use HasFactory;

    protected $table = 'plss_categorias';
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function chamados() {
        return $this->hasMany(Chamado::class, 'categoria_id');
    }
}
