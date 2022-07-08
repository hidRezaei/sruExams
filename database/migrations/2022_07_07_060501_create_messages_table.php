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
        Schema::create('Messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('SenderID');
            $table->bigInteger('ReceiverID')->nullable();
            $table->integer('Subject')->nullable();
            $table->string('Subject2','500')->nullable();
            $table->string('Message','MAX');
            $table->string('Reply')->nullable();
            $table->boolean('View')->default(false)->nullable();
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
        Schema::dropIfExists('Messages');
    }
};
