<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('goods_attribute', function (Blueprint $table) {
            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('attribute_pid')->comment ('属性PID');//
            $table->string ('attribute_name', 50)->comment ('属性名');//
            $table->unsignedBigInteger('cate_id')->comment ('商品分类ID');//
            $table->timestamps ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ('goods_attribute');
    }
}
