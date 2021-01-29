<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsOrderSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create ('goods_order_sub', function (Blueprint $table) {
        //
        //    $table->bigIncrements ('id');//子订单ID
        //    $table->unsignedBigInteger ('order_id');//主订单ID
        //    $table->char ('sub_order_no', 18);//子订单号
        //    $table->unsignedDecimal ('sub_order_amount', 11, 2);//子订单金额
        //    $table->unsignedDecimal ('sub_discount_amount', 11, 2);//折扣金额
        //    $table->unsignedDecimal ('sub_pay_amount', 11, 2);//实付金额
        //    $table->timestamps ();
        //    $table->foreign ('order_id')->references ('id')->on ('goods_order')->onDelete ('cascade');//子订单外键
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists ('goods_order_sub');
    }
}
