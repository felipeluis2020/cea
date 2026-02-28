<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Directiva personalizada: @pcan('permiso', 'modulo_id')
         * Ejemplo: @pcan('ver', 5) ... @endpcan
         */
        Blade::if('pcan', function ($permiso, $moduloId) {
            $user = Auth::user();
            if (!$user || !isset($user->rol_id)) {
                return false;
            }

            return DB::table('permisos')
                ->where('rol_id', $user->rol_id)
                ->where('modulo_id', $moduloId)
                ->where($permiso, 1) // Verifica que el campo (ver, crear, etc) sea 1
                ->where('borrado', 0)
                ->exists();
        });
    }
}
