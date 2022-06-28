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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('FName',300);
            $table->string('LName', 300);
            $table->string('FatherName', 300);
            $table->integer('GenderID');
            $table->string('CodeMeli', 10);
            $table->string('ShSerial', 10);
            $table->integer('StateID');
            $table->integer('StateZoneID');
            $table->integer('SchoolID');
            $table->integer('BranchID');
            $table->integer('GradeID');
            $table->string('Tel', 15);
            $table->string('Password');
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
