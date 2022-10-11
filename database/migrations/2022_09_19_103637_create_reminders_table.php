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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('send_to');
            $table->integer('isSendToMail')->default(0);
            $table->integer('isSendToWhats')->default(0);
            $table->string('dateSend')->nullable();
            $table->string('dateOfLivred');
            $table->string('fileName');
            $table->string('email_to');
            $table->text('message')->nullable();
            $table->text('file_to_send')->nullable();
            $table->string('cc')->nullable();
            $table->text('object')->nullable();
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
        Schema::dropIfExists('reminders');
    }
};
