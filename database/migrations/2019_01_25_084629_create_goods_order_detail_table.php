<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('goods_order_detail', function (Blueprint $table) {

            $table->id ();//订单明细表ID
            $table->unsignedBigInteger('order_id')->comment ('订单ID');//
            $table->unsignedBigInteger('goods_id')->comment ('商品ID');//
            $table->unsignedBigInteger('stock_id')->comment ('库存ID');
            $table->unsignedInteger ('goods_version')->default (0)->comment ('商品版本号');
            $table->unsignedDecimal ('goods_price', 11, 2)->default (0)->comment ('商品价格');//
            $table->unsignedDecimal ('discount_amount', 11, 2)->default (0)->comment ('折扣金额');//
            $table->unsignedDecimal ('market_price', 11, 2)->default (0)->comment ('市场价格');//
            $table->unsignedSmallInteger ('buy_number')->default (0)->comment ('购买数量');//
            $table->timestamps ();
            $table->foreign ('order_id')->references ('id')->on ('goods_order')->onDelete ('cascade');//订单外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('goods_order_detail');
    }
}
