<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAtlasEntityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('school_atlas_entity', function (Blueprint $table) {
            $table->unsignedInteger('school_id');
            $table->foreign('school_id', 'school_id_fk_878224')->references('team_id')->on('teams')->onDelete('cascade');
            $table->unsignedInteger('code_atlas_entity');
            $table->foreign('code_atlas_entity', 'code_atlas_entity_fk_878225')->references('code_atlas_entity')->on('atlas_entity')->onDelete('cascade');
        });
    }
}
