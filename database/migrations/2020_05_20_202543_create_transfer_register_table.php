<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_register', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('child_name');
            $table->string('certificate_number');
            $table->integer('class_id');
            $table->string('last_class_attended');
            $table->string('pupils_conduct');
            $table->string('reason_for_leaving');
            $table->date('last_attendance_date');
            $table->string('old_school');
            $table->string('new_school');
            $table->string('headteacher_name');
            $table->string('headteacher_phone');
            $table->integer('transfer_status');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->unsignedBigInteger('term_id');
            $table->foreign('term_id')->references('id')->on('ds_term');
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('ds_year_session');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_register');
    }
}
