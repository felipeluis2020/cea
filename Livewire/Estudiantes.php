<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use App\Models\Estudiante;
use App\Models\Curso;

use App\Traits\HasPermissions;

class Estudiantes extends Component
{
    use HasPermissions;
    use WithPagination;

    //(ajustar según tu BD)
    public $modulo = 1;

    protected $paginationTheme = 'bootstrap';

    public $selected_id;
    public $keyWord;

    public $numero_documento;
    public $nombre;
    public $apellido;
    public $sexo;
    public $edad;

    public $estado_inscripcion;
    public $estado_matricula;

    // NUEVO: relación con cursos
    public $curso_id;

    // Se mantiene en estudiantes (pero lo autollenamos desde el curso seleccionado)
    public $valor_curso;

    public $saldo;
    public $clase_actual;

    public $fecha_firma_contrato;
    public $metodo_pago;

    #[Computed]
    public function filteredEstudiantes()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return Estudiante::with('curso')
            ->latest()

            ->where(function ($query) use ($keyWord) {
                $query
                    ->orWhere('numero_documento', 'LIKE', $keyWord)
                    ->orWhere('nombre', 'LIKE', $keyWord)
                    ->orWhere('apellido', 'LIKE', $keyWord)
                    ->orWhere('sexo', 'LIKE', $keyWord)
                    ->orWhere('edad', 'LIKE', $keyWord)
                    ->orWhere('estado_inscripcion', 'LIKE', $keyWord)
                    ->orWhere('estado_matricula', 'LIKE', $keyWord)
                    // búsqueda por curso (texto antiguo) o por id
                    ->orWhere('curso_id', 'LIKE', $keyWord)
                    ->orWhere('valor_curso', 'LIKE', $keyWord)
                    ->orWhere('saldo', 'LIKE', $keyWord)
                    ->orWhere('clase_actual', 'LIKE', $keyWord)
                    ->orWhere('fecha_firma_contrato', 'LIKE', $keyWord)
                    ->orWhere('metodo_pago', 'LIKE', $keyWord);
            })
            ->paginate(10);
    }

    public function render()
    {
        if (!$this->can('ver')) {
            return view('error-permisos');
        }

        return view('livewire.estudiantes.view', [
            'estudiantes' => $this->filteredEstudiantes,
            'cursos' => Curso::where('borrado', 0)->orderBy('nombre_curso')->get(),
        ]);
    }

    /**
     * Si seleccionan un curso en el modal, autollenamos el valor del curso
     * para mantener consistencia con tu columna valor_curso en estudiantes.
     */
    public function updatedCursoId($value)
    {
        if (!$value) {
            $this->valor_curso = null;
            return;
        }

        $curso = Curso::where('borrado', 0)->find($value);
        $this->valor_curso = $curso ? $curso->precio_curso : null;
    }

    public function cancel()
    {
        // No resetea el buscador/paginación
        $this->reset([
            'selected_id',
            'numero_documento',
            'nombre',
            'apellido',
            'sexo',
            'edad',
            'estado_inscripcion',
            'estado_matricula',
            'curso_id',
            'valor_curso',
            'saldo',
            'clase_actual',
            'fecha_firma_contrato',
            'metodo_pago',
        ]);
        $this->resetValidation();
    }

    public function save()
    {
        // OJO: si quieres permitir actualizar con el mismo método, la validación de permiso
        // puede separarse en crear/editar. Dejo el esquema simple:
        if ($this->selected_id) {
            if (!$this->validatePermission('editar')) return;
        } else {
            if (!$this->validatePermission('crear')) return;
        }

        $this->validate([
            'numero_documento' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',

            // enums según tu tabla
            'sexo' => 'required|in:M,F,Otro',
            'edad' => 'required|integer|min:0',

            'estado_inscripcion' => 'required|in:Preinscrito,Inscrito,Cancelado',
            'estado_matricula' => 'required|in:Pendiente,Activa,Finalizada,Cancelada',

            // relación
            'curso_id' => 'required|integer|exists:cursos,id',

            // números
            'valor_curso' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'clase_actual' => 'required|integer|min:0',

            // opcionales
            'fecha_firma_contrato' => 'nullable|date',
            'metodo_pago' => 'nullable|in:Efectivo,Transferencia,Tarjeta,Mixto',
        ]);

        Estudiante::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'numero_documento' => $this->numero_documento,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'sexo' => $this->sexo,
                'edad' => $this->edad,

                'estado_inscripcion' => $this->estado_inscripcion,
                'estado_matricula' => $this->estado_matricula,

                'curso_id' => $this->curso_id,

                'valor_curso' => $this->valor_curso,
                'saldo' => $this->saldo,
                'clase_actual' => $this->clase_actual,

                'fecha_firma_contrato' => $this->fecha_firma_contrato,
                'metodo_pago' => $this->metodo_pago,
            ]
        );

        $message = $this->selected_id ? 'Estudiante actualizado.' : 'Estudiante creado.';
        $this->dispatch('closeModal');

        $this->cancel(); // resetea campos sin tumbar el buscador
        session()->flash('message', $message);
    }

    public function edit($id)
    {
        if (!$this->validatePermission('editar')) return;

        $this->selected_id = $id;

        $row = Estudiante::findOrFail($id);

        // fill manual para asegurar curso_id y evitar problemas con casts/relaciones
        $this->numero_documento = $row->numero_documento;
        $this->nombre = $row->nombre;
        $this->apellido = $row->apellido;
        $this->sexo = $row->sexo;
        $this->edad = $row->edad;

        $this->estado_inscripcion = $row->estado_inscripcion;
        $this->estado_matricula = $row->estado_matricula;

        $this->curso_id = $row->curso_id;
        $this->valor_curso = $row->valor_curso;

        $this->saldo = $row->saldo;
        $this->clase_actual = $row->clase_actual;

        $this->fecha_firma_contrato = $row->fecha_firma_contrato;
        $this->metodo_pago = $row->metodo_pago;

        $this->resetValidation();
    }

    public function destroy($id)
    {
        if (!$this->validatePermission('borrar')) return;

        if ($id) {
            Estudiante::where('id', $id)->update(['borrado' => 1]);
        }
    }
}