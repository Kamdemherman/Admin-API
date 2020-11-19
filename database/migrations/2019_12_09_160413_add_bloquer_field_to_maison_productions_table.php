<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBloquerFieldToMaisonProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maison_productions', function (Blueprint $table) {
            $table->boolean('bloquer');
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
                $table->dropColumn('bloquer');
        });
    }
}
