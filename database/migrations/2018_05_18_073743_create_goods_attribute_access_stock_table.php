<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeAccessStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('goods_attribute_access_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('goods_stock_id')->comment ('库存ID');//
            $table->unsignedBigInteger('attribute_access_id')->comment ('属性关联ID');//
            $table->foreign ('goods_stock_id')->references ('id')->on ('goods_stock')->onDelete ('cascade');//商品外键
            $table->foreign ('attribute_access_id')->references ('id')->on ('goods_attribute_access')->onDelete ('cascade');//属性关联外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ('goods_attribute_access_stock');
    }
}
