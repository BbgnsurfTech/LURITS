<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeacherAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {
            $table->unsignedInteger('admission_id')->nullable();

            $table->foreign('admission_id', 'admission_fk_884956')->references('id')->on('teachers');

            $table->unsignedInteger('team_id')->nullable();

            $table->foreign('team_id', 'team_fk_884963')->references('id')->on('teams');
        });
    }
}
