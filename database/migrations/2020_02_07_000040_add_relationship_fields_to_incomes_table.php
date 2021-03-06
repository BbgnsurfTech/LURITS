<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncomesTable extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedInteger('income_category_id')->nullable();
            $table->foreign('income_category_id', 'income_category_fk_937529')->references('id')->on('income_categories');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_972589')->references('id')->on('teams');
        });
    }
}
