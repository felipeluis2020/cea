<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    public $timestamps = true;

    protected $table = 'estudiantes';

    protected $fillable = [
        'numero_documento', 'nombre', 'apellido', 'sexo', 'edad',
        'estado_inscripcion', 'estado_matricula', 'curso_id',
        'valor_curso', 'saldo', 'clase_actual',
        'fecha_firma_contrato', 'metodo_pago'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}