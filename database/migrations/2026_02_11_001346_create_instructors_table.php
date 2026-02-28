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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('sexo');
            $table->string('telefono');
            $table->integer('edad');
            $table->integer('cantidad_horas')->default(0);
            $table->dateTime('fecha_vencimiento_licencia');
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
        Schema::dropIfExists('instructors');
    }
};
