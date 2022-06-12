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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_depart');
            $table->integer('kilometrage_depart');
            $table->double('montant_carburant')->nullable()->default(0);
            $table->double('quantite_carburant')->nullable()->default(0);
            $table->dateTime('date_arrive')->nullable();
            $table->integer('kilometrage_arrive')->nullable();
            $table->string('motif');
            $table->foreignId('vehicule_id')->references('id')->on('vehicules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trajets');
    }
};
