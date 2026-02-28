<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {

            // Agregar columna
            $table->unsignedBigInteger('curso_id')
                  ->nullable()
                  ->after('estado_matricula');

            // Crear llave foránea
            $table->foreign('curso_id')
                  ->references('id')
                  ->on('cursos')
                  ->onDelete('set null'); // si borran curso no rompe estudiantes
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {

            // Eliminar FK primero
            $table->dropForeign(['curso_id']);

            // Luego eliminar columna
            $table->dropColumn('curso_id');
        });
    }
};