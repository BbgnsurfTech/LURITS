<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('status');
            $table->string('description');
            $table->string('address');
            $table->string('notes')->nullable();
            $table->string('remark')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->unsignedBigInteger('term_id');
            $table->foreign('term_id')->references('id')->on('ds_term');
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('ds_year_session');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postal');
    }
}
