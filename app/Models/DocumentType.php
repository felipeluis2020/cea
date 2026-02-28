<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = ['code', 'name'];

    // Relación inversa: Un tipo de documento tiene muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
