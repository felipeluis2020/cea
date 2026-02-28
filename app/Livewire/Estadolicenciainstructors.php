<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estadolicenciainstructor;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Estadolicenciainstructors extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 7;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_estado_licencia_instructor, $borrado;

    #[Computed]
	public function filteredEstadolicenciainstructors()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Estadolicenciainstructor::latest()
            ->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_estado_licencia_instructor', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.estadolicenciainstructors.view', [
			'estadolicenciainstructors' => $this->filteredEstadolicenciainstructors,
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
		'nombre_estado_licencia_instructor' => 'required',
        ]);

        Estadolicenciainstructor::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_estado_licencia_instructor' => $this-> nombre_estado_licencia_instructor,
				'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Estadolicenciainstructor Successfully updated.' : 'Estadolicenciainstructor Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Estadolicenciainstructor::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Estadolicenciainstructor::where('id', $id)->update(['borrado' => 1]);
        }
    }
}