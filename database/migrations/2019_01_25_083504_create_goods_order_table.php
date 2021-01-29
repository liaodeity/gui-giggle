<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('goods_order', function (Blueprint $table) {

            $table->id ();//主订单ID
            $table->char ('order_no', 18)->default ('')->comment ('订单号');//
            $table->unsignedBigInteger('shop_id')->comment ('店铺编号');//
            $table->unsignedBigInteger('user_id')->comment ('下单人');//
            $table->timestamp ('order_at')->nullable ()->comment ('下单时间');//
            $table->unsignedDecimal ('order_amount', 11, 2)->default (0)->comment ('订单金额');//
            $table->unsignedDecimal ('discount_amount', 11, 2)->default (0)->comment ('折扣金额');//
            $table->unsignedDecimal ('pay_amount', 11, 2)->default (0)->comment ('实付金额');//
            $table->tinyInteger ('pay_status')->default (0)->comment ('支付状态[1=已支付,0=未支付,4=已取消]');//
            $table->timestamp ('pay_at')->nullable ()->comment ('支付时间');//
            $table->tinyInteger ('pay_type')->default (0)->comment ('支付类型[1=现金支付,2=银行转账,3=支付宝,4=微信支付]');//
            $table->string ('pay_remark')->default ('')->comment ('支付备注');//
            $table->tinyInteger ('order_status')->default (0)->comment ('订单状态[1=已收货,2=待审核,3=已审核,6=已确认,5=待发货,8=已发货,4=已取消]');//
            $table->tinyInteger ('if_send')->default (0)->comment ('是否已发货');//
            $table->tinyInteger ('if_sign')->default (0)->comment ('是否已签收');//
            $table->string ('order_remark', 200)->default (0)->comment ('订单备注');//
            $table->timestamps ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('goods_order');
    }
}
