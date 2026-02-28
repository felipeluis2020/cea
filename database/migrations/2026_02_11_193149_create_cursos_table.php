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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_curso');
            $table->text('descripcion_curso');
            $table->decimal('precio_curso', 10, 2);
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
        Schema::dropIfExists('cursos');
    }
};
