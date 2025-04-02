@extends('index')

@section('conteudo')

<div class="text-center my-4">
    <span class="fs-4 fw-bold text-dark">
        Seja bem-vindo(a)
        <span class="text-primary">Convidado </span>
        <br>
        ao Sistema de Chamadas!
    </span>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('chamados.index') }}" class="text-decoration-none">
                <div class="card card-hover">
                    <img src="https://cdn-icons-png.flaticon.com/512/3649/3649789.png" class="card-img-top custom-img">
                    <h4 class="custom-title">Chamados</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="#" class="text-decoration-none">
                <div class="card card-hover">
                    <img src="https://cdn-icons-png.flaticon.com/512/2706/2706950.png" class="card-img-top custom-img">
                    <h4 class="custom-title">Atendimento</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="#" class="text-decoration-none">
                <div class="card card-hover">
                    <img src="https://cdn-icons-png.flaticon.com/512/6820/6820955.png" class="card-img-top custom-img">
                    <h4 class="custom-title">Dashboards</h4>
                </div>
            </a>
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

@endsection