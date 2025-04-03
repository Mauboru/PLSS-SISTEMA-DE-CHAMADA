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
        <h2 class="mb-0">Lista de Chamados</h2>
        <a href="{{ route('chamados.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Criar Chamado
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>
                        <a href="{{ route('chamados.index', ['sort' => 'situacao', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none">
                            Situação {!! request('order') === 'asc' ? '🔼' : '🔽' !!}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('chamados.index', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none">
                            Criado em {!! request('order') === 'asc' ? '🔼' : '🔽' !!}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('chamados.index', ['sort' => 'prazo_solucao', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none">
                            Prazo {!! request('order') === 'asc' ? '🔼' : '🔽' !!}
                        </a>
                    </th>
                    <th>Data de Solução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chamados as $chamado)
                    <tr>
                        <td>{{ $chamado->titulo }}</td>
                        <td>{{ $chamado->categoria->nome }}</td>
                        <td>{{ Str::limit($chamado->descricao, 50) }}</td>
                        <td><span class="badge bg-info">{{ $chamado->situacao->nome }}</span></td>
                        <td>{{ $chamado->created_at->format('d/m/Y') }}</td>
                        <td>{{ $chamado->prazo_solucao->format('d/m/Y') }}</td>
                        <td>
                            @if($chamado->data_solucao)
                                <span class="text-success fw-bold">✔️ {{ $chamado->data_solucao->format('d/m/Y') }}</span>
                            @else
                                <span class="text-danger fw-bold">⏳ Pendente</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('chamados.show', $chamado->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Nenhum chamado encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $chamados->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    table {
        user-select: none;
    }
</style>

@endsection
