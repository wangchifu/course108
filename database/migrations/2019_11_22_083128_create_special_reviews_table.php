<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year')->index();
            $table->unsignedInteger('question_id')->index();//題目id
            $table->string('school_code')->index();//學校
            $table->unsignedInteger('user_id')->index();
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
        Schema::dropIfExists('special_reviews');
    }
}
