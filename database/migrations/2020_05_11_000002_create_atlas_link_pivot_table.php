<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtlasLinkPivotTable extends Migration
{
    public function up()
    {
        Schema::create('atlas_link', function (Blueprint $table) {
            $table->unsignedInteger('code_atlas_link');
            $table->foreign('code_atlas_link', 'code_atlas_link_fk_878222')->references('code_atlas_entity')->on('atlas_entity')->onDelete('cascade');
            $table->unsignedInteger('code_atlas_entity');
            $table->foreign('code_atlas_entity', 'code_atlas_entity_fk_878223')->references('code_atlas_entity')->on('atlas_entity')->onDelete('cascade');
        });
    }
}
