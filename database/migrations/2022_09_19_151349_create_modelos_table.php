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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBIgInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->string('nome', 30);
            $table->string('imagem', 100);
            $table->integer('numero_portas');
            $table->integer('lugares');
            $table->boolean('air_bag');
            $table->boolean('abs');
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
        Schema::table('modelos', function(Blueprint $table){
            $table->dropForeign('modelos_marca_id_foreign');
        });
        Schema::dropIfExists('modelos');
    }
};
