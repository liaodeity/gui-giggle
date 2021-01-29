<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('links', function (Blueprint $table) {
            $table->id ();
            $table->string ('title', 100)->default ('')->comment ('网站名称');
            $table->tinyInteger ('link_type')->default (0)->comment ('网站类型[1=子网站,2=友情链接,3=广告链接]');
            $table->string ('link_url', 200)->default ('')->comment ('链接名称');
            $table->string ('description', 200)->default ('')->comment ('简介名称');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=>显示,2=待审核,0=隐藏]');
            $table->smallInteger ('sort')->default (99)->comment ('排序');
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
        Schema::dropIfExists ('links');
    }
}
