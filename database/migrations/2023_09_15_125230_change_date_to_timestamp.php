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
        Schema::table('permisos_persona', function (Blueprint $table) {
            $table->dateTime('fecha_inicio')->change();
            $table->dateTime('fecha_final')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisos_persona', function (Blueprint $table) {
            //
        });
    }
};
