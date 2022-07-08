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
        Schema::create('Students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('oldSystemID')->nullable();
            $table->string('FName',300);
            $table->string('LName', 300);
            $table->string('FatherName', 300)->nullable();
            $table->integer('GenderID')->nullable();
            $table->string('CodeMeli', 10)->unique();
            $table->string('ShSerial', 10)->nullable();
            $table->integer('StateID')->nullable();
            $table->integer('StateZoneID')->nullable();
            $table->integer('SchoolID')->nullable();
            $table->integer('BranchID')->nullable();
            $table->integer('GradeID')->nullable();
            $table->string('Tel', 15)->nullable();
            $table->string('Password');
            $table->string('Eamil')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

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
        Schema::dropIfExists('students');
    }
};
