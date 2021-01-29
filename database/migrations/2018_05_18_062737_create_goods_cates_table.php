<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('goods_cates', function (Blueprint $table) {

            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('pid')->default (0)->comment ('父分类ID');//
            $table->string ('name', 50)->default ('')->comment ('商品分类');//
            $table->unsignedBigInteger('icon')->default (0)->comment ('分类图标');//
            $table->tinyInteger ('status')->default (0)->comment ('分类状态[1=启动,2=隐藏]');//
            $table->integer ('sort')->default (0)->comment ('排序');//
            $table->tinyInteger ('show_index')->default (0)->comment ('是否显示首页[1=显示,2=不显示]');//
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
        Schema::dropIfExists ('goods_cates');
    }
}
