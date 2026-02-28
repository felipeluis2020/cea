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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento', 20)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->enum('sexo', ['M','F','Otro']);
            $table->unsignedTinyInteger('edad');
            $table->enum('estado_inscripcion', ['Preinscrito','Inscrito','Cancelado'])->default('Preinscrito');
            $table->enum('estado_matricula', ['Pendiente','Activa','Finalizada','Cancelada'])->default('Pendiente');
            $table->string('curso', 100);
            $table->decimal('valor_curso', 12, 2);
            $table->decimal('saldo', 12, 2)->default(0);
            $table->integer('clase_actual')->default(0);
            $table->date('fecha_firma_contrato')->nullable();
            $table->enum('metodo_pago', ['Efectivo','Transferencia','Tarjeta','Mixto'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
