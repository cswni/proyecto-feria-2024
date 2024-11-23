<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('sede');
            $table->text('categoria');
            $table->text('area');
            $table->text('requerimientos');
            $table->text('miembros');
            $table->text('telefonos');
            $table->text('tutores');
            $table->float('nota')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
