<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Permiso extends Model
{
	use HasFactory;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'permisos';

    protected $fillable = ['rol_id','modulo_id','crear','ver','editar','borrar','importar','exportar','borrado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function modulo()
    {
        return $this->hasOne('App\Models\Modulo', 'id', 'modulo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol_id');
    }
    
}
