<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSubjectsTable extends Migration
{
    
    public function up()
    {
        Schema::create('ds_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ds_subject_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
