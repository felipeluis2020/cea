<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Instructor;
use App\Models\Estadovehiculo;
use App\Models\Estadomantenimiento;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Totales (El trait BelongsToTenant filtra automáticamente)
        $totalVehiculos = Vehiculo::count();
        $totalInstructores = Instructor::count();

        // Datos para Gráfica de Estado de Vehículos
        $vehiculosPorEstado = Vehiculo::select('estadovehiculo_id', DB::raw('count(*) as total'))
            ->with(['estadovehiculo'=> function ($q){$q ->withoutGlobalScopes();}])
            ->groupBy('estadovehiculo_id')
            ->get();

        $chartEstadoLabels = $vehiculosPorEstado->map(function($item) {
            return $item->estadovehiculo ? $item->estadovehiculo->nombre_estado_vehiculo : 'Desconocido';
        });
        $chartEstadoData = $vehiculosPorEstado->pluck('total');

        // Datos para Gráfica de Mantenimiento
        $vehiculosPorMantenimiento = Vehiculo::select('estadomantenimiento_id', DB::raw('count(*) as total'))
            ->with(['estadomantenimiento'=> function ($q){$q ->withoutGlobalScopes();}])
            ->groupBy('estadomantenimiento_id')
            ->get();
            
        $chartMantenimientoLabels = $vehiculosPorMantenimiento->map(function($item) {
            return $item->estadomantenimiento ? $item->estadomantenimiento->nombre_estado_mantenimiento : 'Desconocido';
        });
        $chartMantenimientoData = $vehiculosPorMantenimiento->pluck('total');

        // Listados recientes
        $recentVehiculos = Vehiculo::with([
            'estadovehiculo' => fn ($q) => $q->withoutGlobalScopes(),
            'estadomantenimiento' => fn ($q) => $q->withoutGlobalScopes(),
        ])->latest()->take(5)->get();
        $recentInstructores = Instructor::with('user')->latest()->take(5)->get();

        return view('home', compact(
            'totalVehiculos', 
            'totalInstructores',
            'chartEstadoLabels',
            'chartEstadoData',
            'chartMantenimientoLabels',
            'chartMantenimientoData',
            'recentVehiculos',
            'recentInstructores'
        ));
    }
}
