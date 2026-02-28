<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Estadovehiculo extends Model
{
	use HasFactory;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'estadovehiculos';

    protected $fillable = ['nombre_estado_vehiculo','borrado'];
	
}
