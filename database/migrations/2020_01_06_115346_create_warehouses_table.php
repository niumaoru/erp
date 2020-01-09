<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('sort');
            $table->tinyInteger('api_type')->comment('接口类型');
            $table->string('warehouse_number')->unique();
            $table->string('warehouse_name');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('warehouse_type')->comment('保税仓库；普通仓库；其它');
            $table->boolean('defect_warehouse')->default(false);
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
        Schema::dropIfExists('warehouses');
    }
}
