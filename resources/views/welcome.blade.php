@extends('layouts.app')
@section('title', __('Inicio'))
@section('content')
<div class="container py-5">
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3 text-primary">Sistema de Gestión Integral para CEA</h1>
            <p class="lead">Administra tu Centro de Enseñanza Automovilística de manera eficiente. Control total sobre instructores, vehículos, alumnos y mantenimientos en una sola plataforma.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-md-2">Ingresar al Sistema</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4 me-md-2">Ir al Dashboard</a>
                @endguest
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Más Información</button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row row-cols-1 row-cols-sm-2 g-4">
                <div class="col d-flex align-items-start">
                    <div class="icon-square bg-light text-dark flex-shrink-0 me-3 rounded p-3">
                        <i class="bi bi-people-fill fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Instructores</h4>
                        <p>Gestión completa de perfiles, licencias y disponibilidad de instructores.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <div class="icon-square bg-light text-dark flex-shrink-0 me-3 rounded p-3">
                        <i class="bi bi-car-front-fill fs-3 text-success"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Vehículos</h4>
                        <p>Control de flota, estados, SOAT, Tecnomecánica y más.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <div class="icon-square bg-light text-dark flex-shrink-0 me-3 rounded p-3">
                        <i class="bi bi-tools fs-3 text-warning"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Mantenimientos</h4>
                        <p>Seguimiento detallado del estado de mantenimiento de cada vehículo.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <div class="icon-square bg-light text-dark flex-shrink-0 me-3 rounded p-3">
                        <i class="bi bi-bar-chart-fill fs-3 text-info"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Estadísticas</h4>
                        <p>Visualización en tiempo real del rendimiento de tu CEA.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection