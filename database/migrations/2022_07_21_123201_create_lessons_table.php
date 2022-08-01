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
        Schema::create('Lessons', function (Blueprint $table) {
            $table->id();
            $table->string('Title','1500');
            $table->string('Code','500')->nullable();
            $table->string('Description','MAX')->nullable();
            //$table->timestamps();
        });

        Schema::create('DorehStepLessons', function (Blueprint $table) {
            //$table->id();
            $table->bigInteger('DorehID')->nullable();
            $table->bigInteger('StepID');
            $table->bigInteger('LessonID');
            $table->smallInteger('QCount')->nullable();
            //$table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Lessons');
    }
};
