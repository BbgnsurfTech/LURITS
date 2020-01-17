<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentGuardianregisterTeamPivotTable extends Migration
{
    public function up()
    {
        Schema::create('parent_guardianregister_team', function (Blueprint $table) {
            $table->unsignedInteger('parent_guardianregister_id');

            $table->foreign('parent_guardianregister_id', 'parent_guardianregister_id_fk_884981')->references('id')->on('parent_guardianregisters')->onDelete('cascade');

            $table->unsignedInteger('team_id');

            $table->foreign('team_id', 'team_id_fk_884981')->references('id')->on('teams')->onDelete('cascade');
        });
    }
}
