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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            //Campos
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_termino');
            //Llaves foraneas
            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->unsignedBigInteger('estatu_id')
                ->nullable();
            $table->foreign('estatu_id')
                ->references('id')
                ->on('estatus')
                ->onDelete('set null');    

            $table->unsignedBigInteger('sala_id')
                ->nullable();
            $table->foreign('sala_id')
                ->references('id')
                ->on('salas')
                ->onDelete('set null');

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
        Schema::dropIfExists('reservas');
    }
};
