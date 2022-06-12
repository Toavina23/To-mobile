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
        Schema::create('echeances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_echeance_id')->references('id')->on('type_echeances');
            $table->foreignId('vehicule_id')->references('id')->on('vehicules');
            $table->date('debut_validite');
            $table->date('fin_validite');
            $table->double('montant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('echeance_majs');
    }
};
