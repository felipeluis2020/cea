<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modulo;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Modulos extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 2;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_modulo, $borrado;

    #[Computed]
	public function filteredModulos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Modulo::latest()
            ->where('borrado', 0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('nombre_modulo', 'LIKE', $keyWord);
			})
            ->orderBy('id', 'desc')
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.modulos.view', [
			'modulos' => $this->filteredModulos,
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
		'nombre_modulo' => 'required',
        ]);

        Modulo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'nombre_modulo' => $this-> nombre_modulo,
				'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Modulo Successfully updated.' : 'Modulo Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Modulo::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Modulo::where('id', $id)->update(['borrado' => 1]);
        }
    }
}