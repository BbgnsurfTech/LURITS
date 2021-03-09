<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Session;

class CreateDsYearSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_year_session', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year');
            $table->string('session');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->tinyInteger('active_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $sample = new Session();
        $sample->year = '2020';
        $sample->starting_date = '2020-05-05';
        $sample->ending_date = '2020-10-05';
        $sample->session = '2019-2020';
        $sample->active_status = 1;
        $sample->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ds_year_session');
    }
}
