<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_937415')->references('id')->on('task_statuses');
            $table->unsignedInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_937419')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_972416')->references('id')->on('teams');
        });
    }
}
