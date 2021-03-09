<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id', 'admission_fk_884856')->references('id')->on('student_admissions');
            $table->unsignedInteger('class_id')->nullable();
            $table->foreign('class_id', 'class_fk_88400')->references('id')->on('classroom');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_884863')->references('id')->on('teams');
        });
    }
}
