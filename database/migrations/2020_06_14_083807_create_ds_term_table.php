<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Term;

class CreateDsTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_term', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('active_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $sample1 = new Term();
        $sample1->name = 'First Term';
        $sample1->active_status = 1;
        $sample1->save();

        $sample2 = new Term();
        $sample2->name = 'Second Term';
        $sample2->active_status = 0;
        $sample2->save();

        $sample3 = new Term();
        $sample3->name = 'Third Term';
        $sample3->active_status = 0;
        $sample3->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ds_term');
    }
}
