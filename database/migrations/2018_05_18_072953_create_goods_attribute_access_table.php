<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('goods_attribute_access', function (Blueprint $table) {

            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('goods_id')->comment ('商品ID');//
            $table->unsignedBigInteger('attribute_id')->comment ('属性名ID');//
            $table->unsignedBigInteger('attribute_value_id')->comment ('属性值ID');//
            $table->string ('show_value', 50)->default ('')->comment ('属性显示名称');
            $table->string ('show_tip', 100)->default ('')->comment ('属性提醒说明');
            $table->unsignedBigInteger('cover_icon')->default (0)->comment ('封面');
            $table->foreign ('attribute_id')->references ('id')->on ('goods_attribute')->onDelete ('cascade');//属性名外键
            $table->foreign ('attribute_value_id')->references ('id')->on ('goods_attribute_value')->onDelete ('cascade');//属性值外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('goods_attribute_access');
    }
}
