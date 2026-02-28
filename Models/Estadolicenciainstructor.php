<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Estadolicenciainstructor extends Model
{
	use HasFactory;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'estadolicenciainstructors';

    protected $fillable = ['nombre_estado_licencia_instructor','borrado'];
	
}
