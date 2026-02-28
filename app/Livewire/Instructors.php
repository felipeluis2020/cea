<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Tenant;
use Livewire\Attributes\Computed;
use App\Traits\HasPermissions;

class Instructors extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 9;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $user_id, $sexo, $telefono, $edad, $cantidad_horas, $fecha_vencimiento_licencia, $tenant_id, $borrado;

    #[Computed]
	public function filteredInstructors()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Instructor::latest()
			->where('borrado', 0	)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('user_id', 'LIKE', $keyWord)
						->orWhere('sexo', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('edad', 'LIKE', $keyWord)
						->orWhere('cantidad_horas', 'LIKE', $keyWord)
						->orWhere('fecha_vencimiento_licencia', 'LIKE', $keyWord)
						->orWhere('tenant_id', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (!$this->can('ver')) {
            return view('error-permisos'); // O una vista vacía
        }

		return view('livewire.instructors.view', [
			'instructors' => $this->filteredInstructors,
            'users' => User::where('tenant_id', auth()->user()->tenant_id)->get(),
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
		'user_id' => 'required',
		'sexo' => 'required',
		'telefono' => 'required',
		'edad' => 'required',
		'cantidad_horas' => 'required',
		'fecha_vencimiento_licencia' => 'required',
		'tenant_id' => 'required',
        ]);

        Instructor::updateOrCreate(
			['id' => $this->selected_id],
			[
				'user_id' => $this-> user_id,
				'sexo' => $this-> sexo,
				'telefono' => $this-> telefono,
				'edad' => $this-> edad,
				'cantidad_horas' => $this-> cantidad_horas,
				'fecha_vencimiento_licencia' => $this-> fecha_vencimiento_licencia,
				'tenant_id' => $this-> tenant_id,
            	'borrado' => 0
			]
		);

        $message = $this->selected_id ? 'Instructor Successfully updated.' : 'Instructor Successfully created.';
		$this->dispatch('closeModal');
        $this->reset();
		session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;
		$this->fill(Instructor::findOrFail($id)->toArray());
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;
        
        if ($id) {
            Instructor::where('id', $id)->update(['borrado' => 1]);
        }
    }
}