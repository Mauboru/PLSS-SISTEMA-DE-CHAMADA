@extends('index')

@section('conteudo')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('chamados.index') }}" class="text-decoration-none">
                <div class="card card-hover">
                    <img src="https://cdn-icons-png.flaticon.com/512/2706/2706950.png" class="card-img-top custom-img">
                    <h4 class="custom-title">Chamados</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2 text-center my-4">
            <span class="fs-4 fw-bold text-dark">
                Seja bem-vindo(a)
                <span class="text-primary">Convidado </span>
                <br>
                ao Sistema de Chamadas!
            </span>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <h5 class="text-primary">📊 Chamados por Categoria</h5>
            <canvas id="chamadosChart" style="max-width: 300px; max-height: 250px;"></canvas>
        </div>
        <div class="col-md-4 text-center">
            <h5 class="text-success">📈 SLA - Chamados Resolvidos no Prazo</h5>
            <canvas id="slaChart" style="max-width: 300px; max-height: 250px;"></canvas>
        </div>
    </div>
</div>

<style>
    .card-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 8px;
        overflow: hidden;
    }

    .custom-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
        text-align: center;
    }

    .card-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var categorias = @json($categorias->pluck('nome')); 
        var chamadosPorCategoria = @json($categorias->map(fn($categoria) => $categoria->chamados->count())); 

        var ctx1 = document.getElementById('chamadosChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Chamados',
                    data: chamadosPorCategoria,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
        var totalChamados = @json($totalChamados);
        var chamadosNoPrazo = @json($chamadosNoPrazo);
        var chamadosForaDoPrazo = totalChamados - chamadosNoPrazo;

        var ctx2 = document.getElementById('slaChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Resolvidos no Prazo', 'Fora do Prazo'],
                datasets: [{
                    data: [chamadosNoPrazo, chamadosForaDoPrazo],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let value = tooltipItem.raw;
                                let percent = ((value / totalChamados) * 100).toFixed(2) + '%';
                                return `${tooltipItem.label}: ${percent}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection