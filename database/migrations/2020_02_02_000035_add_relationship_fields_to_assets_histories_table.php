<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssetsHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('assets_histories', function (Blueprint $table) {
            $table->unsignedInteger('asset_id')->nullable();

            $table->foreign('asset_id', 'asset_fk_937451')->references('id')->on('assets');

            $table->unsignedInteger('status_id')->nullable();

            $table->foreign('status_id', 'status_fk_937452')->references('id')->on('asset_statuses');

            $table->unsignedInteger('location_id')->nullable();

            $table->foreign('location_id', 'location_fk_937453')->references('id')->on('asset_locations');

            $table->unsignedInteger('assigned_user_id')->nullable();

            $table->foreign('assigned_user_id', 'assigned_user_fk_937454')->references('id')->on('users');
        });
    }
}
