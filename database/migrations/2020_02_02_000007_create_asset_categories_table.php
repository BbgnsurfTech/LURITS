<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
