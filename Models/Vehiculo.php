<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Vehiculo extends Model
{
	use HasFactory;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'vehiculos';

    protected $fillable = ['placa_vehiculo','marca_vehiculo','cantidad_horas','fecha_vencimiento_soat','fecha_vencimiento_tecnomecanica','fecha_vencimiento_tarjeta_operacion','estadovehiculo_id','estadomantenimiento_id','tenant_id','borrado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadomantenimiento()
    {
        return $this->hasOne('App\Models\Estadomantenimiento', 'id', 'estadomantenimiento_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadovehiculo()
    {
        return $this->hasOne('App\Models\Estadovehiculo', 'id', 'estadovehiculo_id');
    }
    

    
}
