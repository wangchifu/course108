<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedInteger('topic_id')->index();
            $table->unsignedInteger('year')->index();
            $table->float('order_by');
            $table->unsignedInteger('type');//題目類型
            $table->tinyInteger('need')->nullable();//必填1，非必填null
            $table->unsignedInteger('g_s')->index();//1普教；2特教
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
        Schema::dropIfExists('questions');
    }
}
