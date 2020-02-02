<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('pseudo_code')->nullable();

            $table->string('nemis_code')->nullable();

            $table->string('number_and_street')->nullable();

            $table->string('school_community')->nullable();

            $table->string('village_town')->nullable();

            $table->string('email_address')->nullable();

            $table->string('school_telephone')->nullable();

            $table->string('code_type_sector')->nullable();

            $table->float('latitude_north', 7, 2)->nullable();

            $table->float('longitude_east', 7, 2)->nullable();

            $table->string('ward')->nullable();

            $table->string('nearby_name_school')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
