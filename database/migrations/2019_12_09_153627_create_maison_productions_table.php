
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaisonProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maison_productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('raison_sociale');
            $table->unsignedBigInteger('logo');
            $table->string('description');
            $table->string('annee_creation');
            $table->string('site_web');
            $table->string('page_facebook');
            $table->string('page_youtube');
            $table->string('page_instagram');
            $table->string('page_twitter');
            $table->string('numero_telephone');
            $table->string('numero_telephone_2');
            $table->string('numero_whatsapp');
            $table->string('hash');
            $table->string('pkey');
            $table->string('email');
            
            
            $table->foreign('logo')->references('id')->on('fichiers')
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
        Schema::dropIfExists('maison_productions');
    }
}
