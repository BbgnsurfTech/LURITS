<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtlasEntityTable extends Migration
{
    public function up()
    {
        Schema::create('atlas_entity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code_atlas_entity')->index();
            $table->unsignedInteger('code_ds_atlas_entity');
            $table->string('name_atlas_entity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
