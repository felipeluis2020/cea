<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehiculo;
use App\Models\Estadovehiculo;
use App\Models\Estadomantenimiento;
use App\Models\Tenant;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;
use Carbon\Carbon;

class Vehiculos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 8;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $placa_vehiculo, $marca_vehiculo, $cantidad_horas, $fecha_vencimiento_soat, $fecha_vencimiento_tecnomecanica, $fecha_vencimiento_tarjeta_operacion, $estadovehiculo_id, $estadomantenimiento_id, $tenant_id, $borrado;

	#[Computed]
	public function filteredVehiculos()
	{
		$keyWord = '%' . $this->keyWord . '%';

		return Vehiculo::query()
			->with([
				'estadovehiculo' => fn($q) => $q->withoutGlobalScopes(),
				'estadomantenimiento' => fn($q) => $q->withoutGlobalScopes(),
				'tenant', // este sí debe quedar con scope si es multi-tenant
			])
			->where('borrado', 0)
			->when($this->keyWord, function ($query) use ($keyWord) {
				$query->where(function ($q) use ($keyWord) {
					$q->where('placa_vehiculo', 'LIKE', $keyWord)
					->orWhere('marca_vehiculo', 'LIKE', $keyWord)
					->orWhere('cantidad_horas', 'LIKE', $keyWord)
					->orWhere('fecha_vencimiento_soat', 'LIKE', $keyWord)
					->orWhere('fecha_vencimiento_tecnomecanica', 'LIKE', $keyWord)
					->orWhere('fecha_vencimiento_tarjeta_operacion', 'LIKE', $keyWord)
					->orWhere('estadovehiculo_id', 'LIKE', $keyWord)
					->orWhere('estadomantenimiento_id', 'LIKE', $keyWord);
					// ❌ NO busques tenant_id con LIKE
				});
			})
			->latest()
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

	return view('livewire.vehiculos.view', [
		'vehiculos' => $this->filteredVehiculos,
		'estadovehiculos' => Estadovehiculo::withoutGlobalScopes()->get(),
		'estadomantenimientos' => Estadomantenimiento::withoutGlobalScopes()->get(),
		'tenants' => Tenant::all(), // (solo si Tenant sí tiene tenant_id o no tiene scope)
	]);
	}
	
    public function cancel()
    {
        $this->reset();
    }

    public function save()
    {
        if (!$this->validatePermission('crear')) return;

        $this->validate([
			'placa_vehiculo' => 'required',
			'marca_vehiculo' => 'required',
			'cantidad_horas' => 'required',
			'fecha_vencimiento_soat' => 'required',
			'fecha_vencimiento_tecnomecanica' => 'required',
			'fecha_vencimiento_tarjeta_operacion' => 'required',
			'estadovehiculo_id' => 'required',
			'estadomantenimiento_id' => 'required',
			'tenant_id' => 'required',
        ]);

        Vehiculo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'placa_vehiculo' => $this-> placa_vehiculo,
				'marca_vehiculo' => $this-> marca_vehiculo,
				'cantidad_horas' => $this-> cantidad_horas,
				'fecha_vencimiento_soat' => $this-> fecha_vencimiento_soat,
				'fecha_vencimiento_tecnomecanica' => $this-> fecha_vencimiento_tecnomecanica,
				'fecha_vencimiento_tarjeta_operacion' => $this-> fecha_vencimiento_tarjeta_operacion,
				'estadovehiculo_id' => $this-> estadovehiculo_id,
				'estadomantenimiento_id' => $this-> estadomantenimiento_id,
				'tenant_id' => $this-> tenant_id,
            	'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Vehiculo Successfully updated.' : 'Vehiculo Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$vehiculo = Vehiculo::findOrFail($id);
		$this->fill($vehiculo->toArray());

		$this->fecha_vencimiento_soat = Carbon::parse($vehiculo->fecha_vencimiento_soat)->format('Y-m-d\TH:i');
		$this->fecha_vencimiento_tecnomecanica = Carbon::parse($vehiculo->fecha_vencimiento_tecnomecanica)->format('Y-m-d\TH:i');
		$this->fecha_vencimiento_tarjeta_operacion = Carbon::parse($vehiculo->fecha_vencimiento_tarjeta_operacion)->format('Y-m-d\TH:i');
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Vehiculo::where('id', $id)->update(['borrado' => 1]);
        }
    }
}