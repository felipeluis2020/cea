<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Modulo;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Permisos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 3;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $rol_id, $modulo_id, $crear, $ver, $editar, $borrar, $importar, $exportar, $borrado;

    #[Computed]
	public function filteredPermisos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Permiso::with(['rol', 'modulo'])
			->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('rol_id', 'LIKE', $keyWord)
						->orWhere('modulo_id', 'LIKE', $keyWord)
						->orWhere('crear', 'LIKE', $keyWord)
						->orWhere('ver', 'LIKE', $keyWord)
						->orWhere('editar', 'LIKE', $keyWord)
						->orWhere('borrar', 'LIKE', $keyWord)
						->orWhere('importar', 'LIKE', $keyWord)
						->orWhere('exportar', 'LIKE', $keyWord);
			})
			->orderBy('id', 'desc')
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

        return view('livewire.permisos.view', [
			'permisos' => $this->filteredPermisos,
            'rols' => Rol::all(),
            'modulos' => Modulo::all(),
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
		'rol_id' => 'required',
		'modulo_id' => 'required',
		'crear' => 'required',
		'ver' => 'required',
		'editar' => 'required',
		'borrar' => 'required',
		'importar' => 'required',
		'exportar' => 'required',
        ]);

        Permiso::updateOrCreate(
			['id' => $this->selected_id],
			[
				'rol_id' => $this-> rol_id,
				'modulo_id' => $this-> modulo_id,
				'crear' => $this-> crear,
				'ver' => $this-> ver,
				'editar' => $this-> editar,
				'borrar' => $this-> borrar,
				'importar' => $this-> importar,
				'exportar' => $this-> exportar,
            	'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Permiso Successfully updated.' : 'Permiso Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Permiso::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Permiso::where('id', $id)->update(['borrado' => 1]);
        }
    }
}