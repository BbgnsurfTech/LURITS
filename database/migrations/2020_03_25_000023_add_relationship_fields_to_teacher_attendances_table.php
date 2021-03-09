<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id')->nullable();
            $table->foreign('teacher_id', 'teacher_fk_885')->references('id')->on('teachers');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_884863')->references('id')->on('teams');
        });
    }
}
