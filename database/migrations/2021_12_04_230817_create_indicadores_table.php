<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('categoria');
            $table->text('descripcion')->nullable();
            $table->string('temporalidad')->nullable();
            $table->string('proveedor_dato')->nullable();
            $table->string('fuente')->nullable();
            $table->boolean('tipo')->comment('0/api-1/csv');
            $table->string('direccion_api')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->string('tipo_grafica')->nullable();
            $table->string('nivel_apertura')->nullable();
            $table->string('variable_1')->nullable();
            $table->string('variable_2')->nullable();
            $table->string('variable_3')->nullable();
            $table->string('variable_medida')->nullable();
            $table->boolean('active')->nullable();
            $table->json('datos_indicador');
            $table->boolean('is_original_data');
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
        Schema::dropIfExists('indicadores');
    }
}
