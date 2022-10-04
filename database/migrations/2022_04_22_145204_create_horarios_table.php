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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->unique();
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('tolerancia');
            $table->time('entrada');
            $table->time('salida');
            $table->unsignedInteger('falta');
            $table->time('entrada_mixta')->nullable();
            $table->time('salida_mixta')->nullable();
            $table->foreignId('creado_por')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('horarios');
    }
};
