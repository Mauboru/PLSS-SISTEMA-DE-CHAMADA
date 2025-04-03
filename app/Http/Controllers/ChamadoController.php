<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;

class ChamadoController extends Controller {
    public function index(Request $request) {
        $sort = $request->get('sort', 'created_at'); 
        $order = $request->get('order', 'desc'); 
    
        $query = Chamado::with(['categoria', 'situacao']);
    
        if ($sort === 'situacao') {
            $query->leftJoin('plss_situacoes', 'plss_chamados.situacao_id', '=', 'plss_situacoes.id')
                  ->orderBy('plss_situacoes.nome', $order)
                  ->select('plss_chamados.*'); 
        } else {
            $query->orderBy($sort, $order);
        }
        $chamados = $query->paginate(10)->appends(request()->query());
        return view('chamados.index', compact('chamados'));
    }

    public function create() {
        return view('chamados.create');
    }    

    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:plss_categorias,id',
            'descricao' => 'required|string',
        ]);

        Chamado::create([
            'titulo' => $request->titulo,
            'categoria_id' => $request->categoria_id,
            'descricao' => $request->descricao,
            'prazo_solucao' => now()->addDays(3),
            'situacao_id' => 1,
            'created_at' => now(),
        ]);

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show(Chamado $chamado) {
        return view('chamados.show', compact('chamado'));
    }

    public function edit(Chamado $chamado) {
        return view('chamados.edit', compact('chamado'));
    }

    public function update(Request $request, Chamado $chamado) {
        $request->validate([
            'situacao_id' => 'required|integer|exists:plss_situacoes,id',
        ]);
    
        $chamado->situacao_id = $request->situacao_id;
        $chamado->data_solucao = $request->situacao_id == 3 ? now() : null;
        $chamado->save();
    
        return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy(Chamado $chamado) {
        $chamado->delete();
        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }
}
