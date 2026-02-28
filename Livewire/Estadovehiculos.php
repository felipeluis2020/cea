<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estadovehiculo;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Estadovehiculos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 5;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_estado_vehiculo, $borrado;

    #[Computed]
	public function filteredEstadovehiculos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Estadovehiculo::latest()
            ->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_estado_vehiculo', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.estadovehiculos.view', [
			'estadovehiculos' => $this->filteredEstadovehiculos,
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
		'nombre_estado_vehiculo' => 'required',
        ]);

        Estadovehiculo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_estado_vehiculo' => $this-> nombre_estado_vehiculo,
				'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Estadovehiculo Successfully updated.' : 'Estadovehiculo Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Estadovehiculo::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Estadovehiculo::where('id', $id)->update(['borrado' => 1]);
        }
    }
}