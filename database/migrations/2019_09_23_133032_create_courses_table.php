<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('school_code');
            $table->tinyInteger('leading')->nullable();//1前導學校，null則不是
            $table->unsignedInteger('special_user_id')->nullable();//特教審查
            $table->unsignedInteger('first_user_id')->nullable();//初審者
            $table->string('first_result1')->nullable();//submit已送出，back退回再修改，pass通過但修改，ok通過，excellent優秀進複審
            $table->string('first_result2')->nullable();//submit已送出，back退回三修，ok通過
            $table->string('first_result3')->nullable();//submit已送出，ok通過
            $table->unsignedInteger('second_user_id')->nullable();//複審者
            $table->string('second_result')->nullable();//ok通過，excellent優秀
            $table->string('special_result')->nullable();//submit已送出，ok通過
            $table->tinyInteger('open')->nullable();//狀況：1公開,null則不公開
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
        Schema::dropIfExists('courses');
    }
}
