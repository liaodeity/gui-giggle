<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //自定义视图
        Schema::create('custom_views', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('module_id')->constrained ()->cascadeOnDelete ();
            $table->string ('name',50)->default ('')->comment ('自定义视图');
            $table->string ('title',100)->default ('')->comment ('自定义视图标题');
            $table->tinyInteger ('is_default')->default (0)->comment ('是否默认视图');
            $table->tinyInteger ('status')->default (1)->comment ('状态[1=正常,2=隐藏]');
            $table->smallInteger ('sort')->default (0)->comment ('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_views');
    }
}
