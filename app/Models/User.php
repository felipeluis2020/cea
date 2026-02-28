<?php 

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\BelongsToTenant;

class User extends Authenticatable
{
	/** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use BelongsToTenant;
	
    public $timestamps = true;

    protected $table = 'users';

    protected $fillable = [
        'document_type_id',
        'document_number',
        'nombres',
        'apellidos',
        'email',
        'tenant_id',
        'rol_id',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function documentType()
    {
        return $this->hasOne('App\Models\DocumentType', 'id', 'document_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol_id');
    }
    


    // Helper para saber si es super admin (ajusta según tu lógica)
    public function isSuperAdmin()
    {
        return $this->tenant_id === null; 
    }
    
}
