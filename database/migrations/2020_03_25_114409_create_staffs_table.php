<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_file_number')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable()->unique();
            $table->date('date_of_birth');
            $table->string('first_appointment');
            $table->string('present_appointment');
            $table->string('posting_to_school');
            $table->string('grade_step');
            $table->string('gender');
            $table->string('type_of_staff');
            $table->string('source_of_salary');
            $table->string('present');
            $table->string('academic_qualification');
            $table->string('teaching_qualification');
            $table->string('area_of_specialization');
            $table->string('teaching_type');
            $table->string('subject_of_qualification');
            $table->string('subject_taught');
            $table->string('phone_number')->nullable()->unique();
            $table->string('seminar_workshop')->nullable();
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
        Schema::dropIfExists('staffs');
    }
}
