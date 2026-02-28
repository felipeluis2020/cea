<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Estadomantenimiento extends Model
{
	use HasFactory;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'estadomantenimientos';

    protected $fillable = ['nombre_estado_mantenimiento','borrado'];
	
}
