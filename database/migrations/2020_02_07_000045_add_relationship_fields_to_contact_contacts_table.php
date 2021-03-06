<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_contacts', function (Blueprint $table) {
            $table->unsignedInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_937499')->references('id')->on('contact_companies');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_972587')->references('id')->on('teams');
        });
    }
}
