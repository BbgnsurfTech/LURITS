<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffDisciplinaryBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_disciplinary_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');            
            $table->string('rank');
            $table->string('offence');
            $table->string('response')->nullable();
            $table->string('number_of_offence');
            $table->string('disciplinary_action');
            $table->string('punished_by');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staffs');
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
        Schema::dropIfExists('staff_disciplinary_book');
    }
}
