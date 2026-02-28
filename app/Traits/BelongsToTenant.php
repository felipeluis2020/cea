<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        // 1. Al Consultar: Filtrar por el tenant del usuario actual
        static::addGlobalScope('tenant', function (Builder $builder) {
            // Evitar recursión infinita en el modelo User
            if ($builder->getModel() instanceof User) {
                $guard = Auth::guard();
                if (method_exists($guard, 'hasUser') && !$guard->hasUser()) {
                    return;
                }
            }

            if (Auth::check() && Auth::user()->tenant_id) {
                $builder->where('tenant_id', Auth::user()->tenant_id);
            }
        });

        // 2. Al Crear: Asignar automáticamente el tenant_id
        static::creating(function (Model $model) {
            if (Auth::check() && Auth::user()->tenant_id) {
                $model->tenant_id = Auth::user()->tenant_id;
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}