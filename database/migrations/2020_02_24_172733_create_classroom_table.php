<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomTable extends Migration
{   
    public function up()
    {
        Schema::create('classroom', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class');
            $table->string('arms');
            $table->integer('capacity');
            $table->integer('year');
            $table->string('condition');
            $table->string('length');
            $table->string('width');
            $table->string('floor_material');
            $table->string('wall_material');
            $table->string('roof_material');
            $table->string('seating');
            $table->string('writing_board');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_937657')->references('id')->on('teams');
            $table->unsignedBigInteger('term_id');
            $table->foreign('term_id')->references('id')->on('ds_term');
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('ds_year_session');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}