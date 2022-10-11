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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('raisonsociale')->nullable();
            $table->integer('ste_part')->nullable();
            $table->string('responsable')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->integer('compte')->nullable();
            $table->integer('groupement')->nullable();
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
        Schema::dropIfExists('subscribers');
    }
};
