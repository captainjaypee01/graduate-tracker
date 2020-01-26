<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('name')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('degree')->nullable();
            $table->year('year_graduated')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('job_length')->nullable();
            $table->string('job_position')->nullable();
            $table->string('job_role')->nullable();
            $table->string('work_place')->nullable();
            $table->string('work_industry')->nullable();
            $table->string('work_sector')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
}
