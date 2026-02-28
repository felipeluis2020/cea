<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa_vehiculo');
            $table->string('marca_vehiculo');
            $table->integer('cantidad_horas');
            $table->dateTime('fecha_vencimiento_soat');
            $table->dateTime('fecha_vencimiento_tecnomecanica');
            $table->dateTime('fecha_vencimiento_tarjeta_operacion');
            $table->foreignId('estadovehiculo_id')->constrained()->onDelete('cascade');
            $table->foreignId('estadomantenimiento_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->boolean('borrado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
