<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('for_school_code')->index()->nullable();//給哪所學校
            $table->unsignedInteger('for_user_id')->index()->nullable();//給誰
            $table->unsignedInteger('from_user_id')->index();//誰發的
            $table->text('message');//訊息
            $table->tinyInteger('has_read')->nullable();//誰發的
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
        Schema::dropIfExists('messages');
    }
}
