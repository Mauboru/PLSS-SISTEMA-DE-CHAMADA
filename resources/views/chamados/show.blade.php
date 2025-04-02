@extends('index')

@section('conteudo')
<div class="container">
    <h2 class="mb-4 text-center text-primary">Detalhes do Chamado</h2>

    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">{{ $chamado->titulo }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>📂 Categoria:</strong> {{ $chamado->categoria->nome }}</p>
                    <p><strong>📅 Data de Criação:</strong> {{ $chamado->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>⏳ Prazo de Solução:</strong> {{ $chamado->prazo_solucao->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>🚦 Situação:</strong> <span class="badge bg-info">{{ $chamado->situacao->nome }}</span></p>
                    <p><strong>✅ Data de Solução:</strong> {{ optional($chamado->data_solucao)->format('d/m/Y') ?? 'Ainda não resolvido' }}</p>
                </div>
            </div>
            <hr>
            <p><strong>📝 Descrição:</strong></p>
            <div class="border rounded p-3 bg-light">{{ $chamado->descricao }}</div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center gap-2">
        <a href="{{ route('chamados.index') }}" class="btn btn-outline-secondary px-4">Voltar</a>
        <a href="{{ route('chamados.edit', $chamado->id) }}" class="btn btn-warning px-4">Editar</a>
        <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Excluir</button>
    </div>
    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">⚠️ Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este chamado? Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
