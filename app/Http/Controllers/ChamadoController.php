<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;

class ChamadoController extends Controller {
    public function index() {
        $chamados = Chamado::all();
        return view('chamados.index', compact('chamados'));
    }

    public function create() {
        return view('chamados.create');
    }

    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'required|string',
            'prazo_solucao' => 'date',
        ]);

        Chamado::create([
            'titulo' => $request->titulo,
            'categoria_id' => $request->categoria_id,
            'descricao' => $request->descricao,
            'prazo_solucao' => now()->addDays(3),
            'situacao' => 'Novo',
            'data_criacao' => now(),
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
            'situacao' => 'required|in:Pendente,Resolvido',
        ]);

        $chamado->update([
            'situacao' => $request->situacao,
            'data_solucao' => $request->situacao === 'Resolvido' ? now() : null,
        ]);

        return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy(Chamado $chamado) {
        $chamado->delete();
        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }
}
