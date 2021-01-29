<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('goods', function (Blueprint $table) {
            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('shop_id')->comment ('商店ID');//
            $table->unsignedBigInteger('user_id')->comment ('创建人');//
            $table->unsignedInteger ('version')->default (0)->comment ('商品版本号');
            $table->string ('title', 100)->default ('')->comment ('商品标题');//
            $table->string ('desc', 200)->default ('')->comment ('商品描述');//
            $table->text ('content')->comment ('商品内容');//
            $table->unsignedDecimal ('one_price', 11, 2)->default (0)->comment ('一口价格');//
            $table->integer ('total_stock')->default (0)->comment ('总库存');//
            $table->unsignedDecimal ('market_price', 11, 2)->default (0)->comment ('市场价格');//
            $table->bigInteger ('comment_number')->default (0)->comment ('评论数');//
            $table->bigInteger ('sale_number')->default (0)->comment ('销量');//
            $table->bigInteger ('status')->default (0)->comment ('商品状态[1=发布,2=草稿,3=下架]');//
            $table->timestamps ();
            $table->foreign ('shop_id')->references ('id')->on ('shops')->onDelete ('cascade');//商店外键
            $table->foreign ('user_id')->references ('id')->on ('users')->onDelete ('cascade');//用户外键
        });
        Schema::create ('goods_logs', function (Blueprint $table) {
            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('goods_id')->comment ('商品ID');//
            $table->unsignedInteger ('version')->default (0)->comment ('商品版本号');
            $table->longText ('content')->comment ('版本内容JSON');
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
        Schema::dropIfExists ('goods_logs');
        Schema::dropIfExists ('goods');
        //
    }
}
