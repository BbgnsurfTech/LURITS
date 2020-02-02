<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_locations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
