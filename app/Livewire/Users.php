<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Users extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 4;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $document_type_id, $document_number, $nombres, $apellidos, $email, $tenant_id, $rol_id;

    #[Computed]
	public function filteredUsers()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return User::with(['documentType', 'tenant', 'rol'])->latest()
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('document_type_id', 'LIKE', $keyWord)
						->orWhere('document_number', 'LIKE', $keyWord)
						->orWhere('nombres', 'LIKE', $keyWord)
						->orWhere('apellidos', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('tenant_id', 'LIKE', $keyWord)
						->orWhere('rol_id', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.users.view', [
			'users' => $this->filteredUsers,
            'document_types' => \App\Models\DocumentType::all(),
            'tenants' => \App\Models\Tenant::all(),
            'rols' => \App\Models\Rol::all(),
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
		'nombres' => 'required',
		'apellidos' => 'required',
		'email' => 'required',
		'tenant_id' => 'required',
        ]);

        User::updateOrCreate(
			['id' => $this->selected_id],
			[
				'document_type_id' => $this-> document_type_id,
				'document_number' => $this-> document_number,
				'nombres' => $this-> nombres,
				'apellidos' => $this-> apellidos,
				'email' => $this-> email,
				'rol_id' => $this-> rol_id,
				'tenant_id' => $this-> tenant_id,
            	'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'User Successfully updated.' : 'User Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(User::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            User::where('id', $id)->update(['borrado' => 1]);
        }
    }
}