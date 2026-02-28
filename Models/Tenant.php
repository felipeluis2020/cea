<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tenants';

    protected $fillable = ['name','nit','is_active'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'tenant_id', 'id');
    }
    
}
