<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsLcrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_lcr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('certificate_number')->nullable();
            $table->date('date_of_graduation');
            $table->string('last_class_passed_id');
            $table->string('parent_guardian_id');
            $table->string('headteacher_name');
            $table->string('headteacher_phone');
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
        Schema::dropIfExists('ds_lcr');
    }
}
