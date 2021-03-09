<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaskStatusesTable extends Migration
{
    public function up()
    {
        Schema::table('task_statuses', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_972415')->references('id')->on('teams');
        });
    }
}
