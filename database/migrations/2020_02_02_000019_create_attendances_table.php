<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');

            $table->string('attendance_status_morninig');

            $table->string('attendance_status_afternoon');

            $table->string('late_status_y_n')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
