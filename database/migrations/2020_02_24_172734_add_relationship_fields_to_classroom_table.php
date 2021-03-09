<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClassroomTable extends Migration
{
    public function up()
    {
        Schema::table('classroom', function (Blueprint $table) {
            $table->unsignedInteger('school_enrolled_id')->nullable();
            $table->foreign('school_enrolled_id', 'school_enrolled_fk_88279')->references('id')->on('teams');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_93765')->references('id')->on('teams');
        });
    }
}
