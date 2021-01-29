<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('goods_stock', function (Blueprint $table) {

            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger ('sku_no')->comment ('库存编号');//
            $table->unsignedBigInteger('goods_id')->comment ('商品ID');//
            //$table->unsignedBigInteger('attribute_access_id')->comment ('属性关联ID');//存在多个属性对应一个库存
            $table->bigInteger ('price')->default (0)->comment ('价格');//
            $table->integer ('stock_number')->default (0)->comment ('库存');//
            $table->integer ('stock_sale_number')->default (0)->comment ('销量');//
            $table->timestamps ();
            $table->foreign ('goods_id')->references ('id')->on ('goods')->onDelete ('cascade');//商品外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ('goods_stock');
    }
}
