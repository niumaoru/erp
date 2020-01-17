<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_number')->unique();
            $table->string('product_name')->unique();
            $table->string('short_name')->nullable();
            $table->string('category')->nullable();
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('specification')->nullable()->comment('规格');
            $table->string('country')->comment('原产国');
            $table->string('unit')->nullable()->comment('计量单位');
            $table->decimal('weight');
            $table->decimal('volume');
            $table->string('record_code')->unique()->comment('账册备案料号');
            $table->string('barcode')->unique()->comment('条形码');
            $table->string('hs_code');
            $table->boolean('enable')->default(true);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('products');
    }
}
