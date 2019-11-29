<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year')->index();
            $table->string('e1')->nullable();//國小一年級的課程9year為九年一貫；12year為十二年國教
            $table->string('e2')->nullable();
            $table->string('e3')->nullable();
            $table->string('e4')->nullable();
            $table->string('e5')->nullable();
            $table->string('e6')->nullable();
            $table->string('j1')->nullable();//園中一年級
            $table->string('j2')->nullable();
            $table->string('j3')->nullable();
            $table->string('step1_date1')->nullable();//學校上傳時間區間1
            $table->string('step1_date2')->nullable();//學校上傳時間區間2
            $table->string('step2_date1')->nullable();//初審作業1
            $table->string('step2_date2')->nullable();//初審作業2
            $table->string('step2_1_date1')->nullable();//依初審修正再傳1
            $table->string('step2_1_date2')->nullable();//依初審修正再傳2
            $table->string('step2_2_date1')->nullable();//依初審修正三傳1
            $table->string('step2_2_date2')->nullable();//依初審修正三傳2
            $table->string('step3_date1')->nullable();//複審1
            $table->string('step3_date2')->nullable();//複審2
            $table->string('step4_date1')->nullable();//開放查詢1
            $table->string('step4_date2')->nullable();//開放查詢2
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
        Schema::dropIfExists('years');
    }
}
