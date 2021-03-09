<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAdmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('child_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->integer('admission');
            $table->string('gender');
            $table->string('state_origin');
            $table->string('nationality_1');
            $table->string('hubby')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
