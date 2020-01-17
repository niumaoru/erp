<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('sort')->comment('店铺排序，常用店铺优先展示');
            $table->string('shop_number')->unique();
            $table->string('shop_name')->unique();
            $table->bigInteger('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->boolean('enable')->default(true);
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
        Schema::dropIfExists('shops');
    }
}
