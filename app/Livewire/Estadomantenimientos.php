<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estadomantenimiento;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Estadomantenimientos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 6;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_estado_mantenimiento, $borrado;

    #[Computed]
	public function filteredEstadomantenimientos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Estadomantenimiento::latest()
            ->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_estado_mantenimiento', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.estadomantenimientos.view', [
			'estadomantenimientos' => $this->filteredEstadomantenimientos,
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
		'nombre_estado_mantenimiento' => 'required',
        ]);

        Estadomantenimiento::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_estado_mantenimiento' => $this-> nombre_estado_mantenimiento,
				'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Estadomantenimiento Successfully updated.' : 'Estadomantenimiento Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Estadomantenimiento::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Estadomantenimiento::where('id', $id)->update(['borrado' => 1]);
        }
    }
}