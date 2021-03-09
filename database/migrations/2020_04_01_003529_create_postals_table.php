<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('status');
            $table->string('description');
            $table->string('address');
            $table->string('notes')->nullable();
            $table->string('remark')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_880015')->references('id')->on('teams');
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
        Schema::dropIfExists('postals');
    }
}
