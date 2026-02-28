<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cursos';

    protected $fillable = ['nombre_curso','descripcion_curso','precio_curso','tenant_id','borrado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tenant()
    {
        return $this->hasOne('App\Models\Tenant', 'id', 'tenant_id');
    }
    
}
