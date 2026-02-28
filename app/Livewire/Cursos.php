<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;
use App\Models\Tenant;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Cursos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 10;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_curso, $descripcion_curso, $precio_curso, $tenant_id, $borrado;

    #[Computed]
	public function filteredCursos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Curso::latest()
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_curso', 'LIKE', $keyWord)
						->orWhere('descripcion_curso', 'LIKE', $keyWord)
						->orWhere('precio_curso', 'LIKE', $keyWord)
						->orWhere('tenant_id', 'LIKE', $keyWord)
						->orWhere('borrado', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.cursos.view', [
			'cursos' => $this->filteredCursos,
            'tenants' => Tenant::all(),
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
			'nombre_curso' => 'required|string|max:255',
			'descripcion_curso' => 'required|string',
			'precio_curso' => 'required|numeric|min:0',
			'tenant_id' => 'required|integer|exists:tenants,id',
			// borrado NO se valida porque no viene del form
		]);

		Curso::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_curso' => $this->nombre_curso,
				'descripcion_curso' => $this->descripcion_curso,
				'precio_curso' => $this->precio_curso,
				'tenant_id' => $this->tenant_id,
				'borrado' => 0,
			]
		);

		$message = $this->selected_id ? 'Curso actualizado.' : 'Curso creado.';
		$this->dispatch('closeModal');
		$this->reset(['selected_id', 'keyWord', 'nombre_curso', 'descripcion_curso', 'precio_curso', 'tenant_id', 'borrado']);
		session()->flash('message', $message);
	}

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Curso::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Curso::where('id', $id)->update(['borrado' => 1]);
        }
    }
}