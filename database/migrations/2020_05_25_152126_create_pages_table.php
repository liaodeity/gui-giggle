<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('pages', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('category_id')->nullable ()->comment ('所属分类');
            $table->string ('link_name', 20)->default ('')->comment ('链接标识');
            $table->string ('title', 200)->default ('')->comment ('标题');
            $table->unsignedBigInteger('cover_id')->nullable ()->comment ('封面图片');
            $table->string ('sub_title', 100)->default ('')->comment ('副标题');
            $table->unsignedInteger ('view_number')->default (0)->comment ('浏览次数');
            $table->string ('description', 500)->default ('')->comment ('简要描述');
            $table->longText ('content')->comment ('内容');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('修改人');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=显示,4=隐藏]');
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
        Schema::dropIfExists ('pages');
    }
}
