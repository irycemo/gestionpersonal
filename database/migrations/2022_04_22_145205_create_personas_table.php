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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero_empleado');
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->unsignedBigInteger('codigo_barras');
            $table->string('localidad');
            $table->string('area');
            $table->string('tipo');
            $table->string('rfc');
            $table->string('curp');
            $table->string('telefono');
            $table->text('domicilio');
            $table->string('email')->nullable();
            $table->date('fecha_ingreso');
            $table->text('observaciones')->nullable();
            $table->foreignId('horario_id')->nullable()->constrained()->references('id')->on('horarios');
            $table->foreignId('creado_por')->nullable()->constrained()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->constrained()->references('id')->on('users');
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
        Schema::dropIfExists('personas');
    }
};
