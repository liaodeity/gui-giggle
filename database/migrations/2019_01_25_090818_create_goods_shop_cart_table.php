<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsShopCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('goods_shop_cart', function (Blueprint $table) {

            $table->id ();//购物车ID
            $table->unsignedBigInteger('goods_id');//商品ID
            $table->unsignedBigInteger('user_id');//添加人
            $table->integer ('buy_number');//购买数量
            $table->tinyInteger ('if_check');//是否勾选
            $table->timestamps ();
            $table->foreign ('goods_id')->references ('id')->on ('goods')->onDelete ('cascade');//商品外键
            $table->foreign ('user_id')->references ('id')->on ('users')->onDelete ('cascade');//用户外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ('goods_shop_cart');
    }
}
