<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('group_id')->index();
            $table->string('email')->nullable();//email改為可null
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique();//增加使用 username 登入的欄位
            $table->string('password');
            $table->tinyInteger('admin')->nullable();//增加可以使用管理者的欄位
            $table->string('code')->nullable();
            $table->string('school')->nullable();
            $table->string('kind')->nullable();
            $table->string('title')->nullable();
            $table->string('login_type')->nullable();//null為本機登入,gsuite為gsuite登入
            $table->tinyInteger('disable')->nullable();//1為停用,null為啟用
            $table->string('access_token')->nullable();//line的toaen
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
