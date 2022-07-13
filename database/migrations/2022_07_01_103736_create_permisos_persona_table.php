<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained();
            $table->foreignId('permisos_id')->references('id')->on('permisos');
            $table->foreignId('creado_por')->nullable()->constrained()->references('id')->on('users');
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();
            $table->integer('tiempo_consumido')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_persona');
    }
};
