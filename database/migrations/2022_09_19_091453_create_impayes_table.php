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
        Schema::create('impayes', function (Blueprint $table) {
            $table->id();
            $table->string('exercice')->nullable();
            $table->integer('quitance')->nullable();
            $table->string('cie')->nullable();
            $table->string('souscripteur')->nullable();
            $table->string('branche')->nullable();
            $table->string('categorie')->nullable();
            $table->string('risque')->nullable();
            $table->string('police')->nullable();
            $table->string('du')->nullable();
            $table->string('au')->nullable();
            $table->string('prime_total')->nullable();
            $table->string('mtt_ancaiss')->nullable();
            $table->string('ref_encaiss')->nullable();
            $table->string('aperiteur')->nullable();
            $table->string('id_client')->nullable();
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
        Schema::dropIfExists('impayes');
    }
};
