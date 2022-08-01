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
        Schema::create('mosahehs', function (Blueprint $table) {
            //$table->id();
            //$table->timestamps();

        });

        Schema::create('DorehStepLessonStudents', function (Blueprint $table) {
            //$table->id();
            $table->bigInteger('DorehID');
            $table->bigInteger('StepID')->nullable();
            $table->bigInteger('LessonID');
            $table->bigInteger('StudentID');
            $table->string('Code')->nullable();
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
        Schema::dropIfExists('mosahehs');
    }
};
