<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('child_name');
            $table->string('certificate_number');
            $table->integer('class_id');
            $table->string('last_class_attended');
            $table->string('pupils_conduct');
            $table->string('reason_for_leaving');
            $table->date('last_attendace_date');
            $table->string('old_school');
            $table->string('new_school');
            $table->string('headteacher_name');
            $table->string('headteacher_phone');
            $table->integer('transfer_status');
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
        Schema::dropIfExists('transfers');
    }
}
