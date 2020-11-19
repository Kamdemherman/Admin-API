<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoverFaceBFieldToAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            
             $table->unsignedBigInteger('cover_face_b')->change();
              $table->foreign('cover_face_b')->references('id')->on('fichiers')
                    ->onDelete('restrict')
                    ->onUpdate('restrict'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
           Schema::dropIfExists('albums');
        });
    }
}
