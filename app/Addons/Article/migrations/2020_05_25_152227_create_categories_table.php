<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('categories', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('pid')->default (0)->comment ('父编号');
            $table->string ('link_name', 20)->default ('')->comment ('链接标识');
            $table->unsignedBigInteger('banner_id')->nullable ()->comment ('栏目图片');
            $table->string ('title', 100)->default ('')->comment ('栏目名称');
            $table->string ('sub_title', 150)->default ('')->comment ('栏目副标题');
            $table->string ('url')->default ('')->comment ('链接地址');
            $table->string ('module', 200)->default ('')->comment ('所属模块');
            $table->string ('template', 50)->default ('')->comment ('显示模板');
            $table->smallInteger ('sort')->default (99)->comment ('排序');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=显示,4=隐藏]');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('修改人');
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
        Schema::dropIfExists ('categories');
    }
}
