<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_id');
            $table->string('status')->nullable();
            $table->string('rank');
            $table->string('contact_number');
            $table->string('address');
            $table->string('number_of_days');
            $table->string('leave_type');
            $table->string('remark')->nullable();
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('leave');
    }
}
