<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCateIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('goods_cate_id', function (Blueprint $table) {

            $table->unsignedBigInteger('cate_id')->primary ()->comment ('分类ID');//
            $table->unsignedBigInteger('goods_id')->comment ('商品ID');//
            $table->foreign ('goods_id')->references ('id')->on ('goods')->onDelete ('cascade');//商品外键
            $table->foreign ('cate_id')->references ('id')->on ('goods_cates')->onDelete ('cascade');//分类外键
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
        Schema::dropIfExists ('goods_cate_id');
    }
}
