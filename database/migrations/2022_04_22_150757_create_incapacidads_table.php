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
        Schema::create('incapacidads', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->string('documento')->nullable();
            $table->string('tipo');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->foreignId('persona_id')->constrained();
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
        Schema::dropIfExists('incapacidads');
    }
};
