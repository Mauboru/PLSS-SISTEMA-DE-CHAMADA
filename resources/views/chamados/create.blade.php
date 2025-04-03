@extends('index')

@section('conteudo')

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Novo Chamado</h2>
    </div>

    <div class="container">
        <form action="{{ route('chamados.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    @foreach(App\Models\Categoria::all() as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="prazo" class="form-label">Prazo de Solução</label>
                        <input type="date" name="prazo" id="prazo" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-control" id="situacao" name="situacao" disabled>
                            <option selected>Novo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dataCriacao" class="form-label">Data de Criação</label>
                        <input type="date" name="dataCriacao" id="dataCriacao" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dataSolucao" class="form-label">Data de Solução</label>
                        <input type="text" name="dataSolucao" id="dataSolucao" class="form-control" value="Não Solucionado" disabled>
                    </div>
                </div>
            </div>
            <a href="{{ route('chamados.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let dataAtual = new Date();
        dataAtual.setDate(dataAtual.getDate() + 3); 
        let ano = dataAtual.getFullYear();
        let mes = String(dataAtual.getMonth() + 1).padStart(2, '0'); 
        let dia = String(dataAtual.getDate()).padStart(2, '0'); 
        document.getElementById("prazo").value = `${ano}-${mes}-${dia}`;
    });

    document.addEventListener("DOMContentLoaded", function () {
        let hoje = new Date();
        let dataFormatada = hoje.toISOString().split('T')[0]; 
        document.getElementById("dataCriacao").value = dataFormatada;
        let prazo = new Date();
        prazo.setDate(prazo.getDate() + 3);
        let prazoFormatado = prazo.toISOString().split('T')[0];
        document.getElementById("prazo").value = prazoFormatado;
    });
</script>

<style>
    table {
        user-select: none; 
    }
</style>

@endsection
