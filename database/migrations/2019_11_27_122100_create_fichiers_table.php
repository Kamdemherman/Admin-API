<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('chemin');
            $table->string('date_creation');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('fichiers');
    }
}