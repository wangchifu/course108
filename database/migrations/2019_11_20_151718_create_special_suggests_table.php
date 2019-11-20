<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_suggests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('question_id');//題目id
            $table->string('school_code');//學校
            $table->tinyInteger('pass')->nullable();//1通過，0則不是
            $table->text('suggest')->nullable();//建議
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
        Schema::dropIfExists('special_suggests');
    }
}
