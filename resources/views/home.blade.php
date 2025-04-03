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
        var chamadosResolvidosNoPrazo = @json($chamadosNoPrazo);
        var chamadosResolvidosForaDoPrazo = @json($chamadosForaPrazo);
        var chamadosNaoResolvidos = totalChamados - (chamadosResolvidosNoPrazo + chamadosResolvidosForaDoPrazo);

        var ctx2 = document.getElementById('slaChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Resolvidos no Prazo', 'Resolvidos Fora do Prazo', 'Não Resolvidos'],
                datasets: [{
                    data: [chamadosResolvidosNoPrazo, chamadosResolvidosForaDoPrazo, chamadosNaoResolvidos],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let dataset = tooltipItem.dataset.data;
                                let total = dataset.reduce((acc, value) => acc + value, 0);
                                let valor = dataset[tooltipItem.dataIndex];
                                let porcentagem = ((valor / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${porcentagem}%`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            generateLabels: function(chart) {
                                let data = chart.data.datasets[0].data;
                                let total = data.reduce((acc, value) => acc + value, 0);
                                return chart.data.labels.map((label, i) => {
                                    let value = data[i];
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return {
                                        text: `${label}: ${percentage}%`,
                                        fillStyle: chart.data.datasets[0].backgroundColor[i],
                                        hidden: isNaN(value) || value <= 0
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection