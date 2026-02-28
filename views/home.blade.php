@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container">
    <h1 class="mt-2 mb-4">Dashboard</h1>
    
    <!-- KPI Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-6 col-md-6">
            <div class="card bg-primary text-white mb-4 h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $totalVehiculos }}</h4>
                        <div class="small">Total Vehículos</div>
                    </div>
                    <i class="bi bi-car-front-fill fs-1 opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="{{ url('/vehiculos') }}">Ver Detalles</a>
                    <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card bg-success text-white mb-4 h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $totalInstructores }}</h4>
                        <div class="small">Total Instructores</div>
                    </div>
                    <i class="bi bi-person-badge-fill fs-1 opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="{{ url('/instructors') }}">Ver Detalles</a>
                    <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white">
                    <i class="bi bi-pie-chart-fill me-1"></i>
                    Estado de Vehículos
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div style="width: 100%; max-width: 400px; height: 300px;">
                        <canvas id="estadoVehiculosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white">
                    <i class="bi bi-bar-chart-fill me-1"></i>
                    Mantenimiento de Vehículos
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div style="width: 100%; max-width: 100%; height: 300px;">
                        <canvas id="mantenimientoVehiculosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-table me-1"></i> Vehículos Recientes</span>
                    <a href="{{ url('/vehiculos') }}" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Estado</th>
                                    <th>Mantenimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->placa_vehiculo }}</td>
                                        <td><span class="badge bg-secondary">{{ $vehiculo->estadovehiculo->nombre_estado_vehiculo ?? 'N/A' }}</span></td>
                                        <td><span class="badge bg-info text-dark">{{ $vehiculo->estadomantenimiento->nombre_estado_mantenimiento ?? 'N/A' }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">No hay vehículos registrados</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-table me-1"></i> Instructores Recientes</span>
                    <a href="{{ url('/instructors') }}" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Licencia Vence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentInstructores as $instructor)
                                    <tr>
                                        <td>{{ $instructor->user->nombres ?? '' }} {{ $instructor->user->apellidos ?? '' }}</td>
                                        <td>{{ $instructor->fecha_vencimiento_licencia }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="text-center text-muted">No hay instructores registrados</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Estado Vehiculos Chart
        const ctxEstado = document.getElementById('estadoVehiculosChart').getContext('2d');
        new Chart(ctxEstado, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartEstadoLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartEstadoData) !!},
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d', '#0dcaf0'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Mantenimiento Vehiculos Chart
        const ctxMantenimiento = document.getElementById('mantenimientoVehiculosChart').getContext('2d');
        new Chart(ctxMantenimiento, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartMantenimientoLabels) !!},
                datasets: [{
                    label: 'Vehículos',
                    data: {!! json_encode($chartMantenimientoData) !!},
                    backgroundColor: '#0d6efd',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endpush