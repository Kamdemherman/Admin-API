<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            
	    $table->bigIncrements('id');
            $table->timestamps();
            $table->string('artiste');
            $table->integer('annee_sortie');
            $table->string('genre_musical');
            $table->string('type_album');
            $table->string('copyright');
            $table->integer('cover_face_a');
            $table->integer('cover_face_b');
            $table->string('date_sortie_officielle');
            $table->boolean('precommandable');
            $table->unsignedBigInteger('fichier');
            $table->unsignedBigInteger('fichier_precommande');
            $table->string('bonus_precommande');
            $table->string('description');
            $table->string('credits');
            $table->string('producteur');
            $table->string('tracklist');
            $table->unsignedBigInteger('admin');
           
            $table->foreign('admin')->references('id')->on('users')
                   ->onDelete('restrict')
                   ->onUpdate('restrict');
              
             $table->foreign('fichier')->references('id')->on('fichiers')
                    ->onDelete('restrict')
                    ->onUpdate('restrict'); 
             
             $table->foreign('fichier_precommande')->references('id')->on('fichiers')
                    ->onDelete('restrict')
                    ->onUpdate('restrict'); 
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
