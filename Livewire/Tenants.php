<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenant;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Tenants extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 1;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $nit, $is_active;

    #[Computed]
	public function filteredTenants()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Tenant::latest()
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('nit', 'LIKE', $keyWord)
						->orWhere('is_active', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.tenants.view', [
			'tenants' => $this->filteredTenants,
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
		'name' => 'required',
		'is_active' => 'required',
        ]);

        Tenant::updateOrCreate(
			['id' => $this->selected_id],
			[
				'name' => $this-> name,
				'nit' => $this-> nit,
				'is_active' => $this-> is_active,
            'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Tenant Successfully updated.' : 'Tenant Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Tenant::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Tenant::where('id', $id)->update(['borrado' => 1]);
        }
    }
}