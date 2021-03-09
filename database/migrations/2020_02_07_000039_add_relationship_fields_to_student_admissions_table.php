<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentAdmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('student_admissions', function (Blueprint $table) {
            $table->unsignedInteger('school_enrolled_id')->nullable();
            $table->foreign('school_enrolled_id', 'school_enrolled_fk_882798')->references('id')->on('teams');
            $table->unsignedInteger('parent_guardian_id')->nullable();
            $table->foreign('parent_guardian_id', 'parent_guardian_fk_886379')->references('id')->on('parent_guardianregisters');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_937657')->references('id')->on('teams');
        });
    }
}
