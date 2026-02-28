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
        Schema::create('estadolicenciainstructors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estado_licencia_instructor');
            $table->timestamps();
            $table->boolean('borrado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadolicenciainstructors');
    }
};
