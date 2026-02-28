<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rol;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Rols extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 1;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_rol, $borrado;

    #[Computed]
	public function filteredRols()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Rol::latest()
            ->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_rol', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.rols.view', [
			'rols' => $this->filteredRols,
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
		'nombre_rol' => 'required',
        ]);

        Rol::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_rol' => $this-> nombre_rol,
                'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Rol Successfully updated.' : 'Rol Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Rol::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Rol::where('id', $id)->update(['borrado' => 1]);
        }
    }
}