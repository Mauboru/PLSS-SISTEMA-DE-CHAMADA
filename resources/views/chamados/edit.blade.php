@extends('index')

@section('conteudo')
<div class="container">
    <h2 class="mb-4 text-center text-warning">Editar Chamado</h2>

    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <form action="{{ route('chamados.update', $chamado->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><strong>Título:</strong></label>
                        <input type="text" class="form-control" value="{{ $chamado->titulo }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><strong>Categoria:</strong></label>
                        <input type="text" class="form-control" value="{{ $chamado->categoria->nome }}" readonly>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label class="form-label"><strong>Descrição:</strong></label>
                    <textarea class="form-control" rows="3" readonly>{{ $chamado->descricao }}</textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label"><strong>Situação:</strong></label>
                        <select class="form-select" name="situacao_id" id="situacao">
                            <option value="2" {{ $chamado->situacao_id == 2 ? 'selected' : '' }}>Pendente</option>
                            <option value="3" {{ $chamado->situacao_id == 3 ? 'selected' : '' }}>Resolvido</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><strong>Data de Solução:</strong></label>
                        <input type="text" class="form-control" id="data_solucao" value="{{ optional($chamado->data_solucao)->format('d/m/Y') }}" readonly>
                    </div>
                </div>
                
                <div class="mt-4 d-flex justify-content-center gap-2">
                    <a href="{{ route('chamados.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('situacao').addEventListener('change', function () {
        let dataSolucao = document.getElementById('data_solucao');
        if (this.value === '3') {
            let hoje = new Date().toLocaleDateString('pt-BR');
            dataSolucao.value = hoje;
        } else {
            dataSolucao.value = '';
        }
    });
</script>
@endsection
