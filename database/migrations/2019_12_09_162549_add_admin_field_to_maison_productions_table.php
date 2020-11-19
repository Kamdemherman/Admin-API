<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminFieldToMaisonProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maison_productions', function (Blueprint $table) {
             $table->unsignedBigInteger('admin');
             
              $table->foreign('admin')->references('id')->on('users')
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
        Schema::table('maison_productions', function (Blueprint $table) {
            //
        });
    }
}
