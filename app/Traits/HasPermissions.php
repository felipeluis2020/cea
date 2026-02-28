<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait HasPermissions
{
    /**
     * Verifica si el usuario autenticado tiene un permiso específico
     * en el módulo actual.
     */
    public function can($permiso)
    {
        // Asumimos que el componente tiene una propiedad $modulo_id definida
        if (!isset($this->modulo)) {
            return false;
        }

        $user = Auth::user();
        if (!$user || !isset($user->rol_id)) {
            return false;
        }

        $permisos = DB::table('permisos')
            ->where('rol_id', $user->rol_id)
            ->where('modulo_id', $this->modulo)
            ->where('borrado', 0)
            ->first();

        return $permisos && $permisos->$permiso == 1;
    }

    /**
     * Valida el permiso y lanza una excepción o detiene el proceso si no lo tiene.
     */
    public function validatePermission($permiso)
    {
        if (!$this->can($permiso)) {
            session()->flash('error', 'No tienes permisos para realizar esta acción.');
            return false;
        }
        return true;
    }
}