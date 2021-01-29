<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create ('parameters', function (Blueprint $table) {
            $table->id ();
            $table->string ('name', 100)->comment ('字段名称');
            $table->string ('model', 200)->default ('')->comment ('所属模型');
            $table->string ('title', 200)->default ('')->comment ('类型名称');
            $table->timestamps ();
        });
        Schema::create ('parameter_items', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('parameter_id');
            $table->tinyInteger ('key')->comment ('键');
            $table->string ('item')->comment ('名称');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=正常,2=隐藏]');
            $table->string ('color', 50)->default ('')->comment ('颜色');
            $table->smallInteger ('sort')->default (99)->comment ('排序');
            $table->timestamps ();
            $table->foreign ('parameter_id')->references ('id')->on ('parameters')->onDelete ('cascade');//外键
            $table->unique (['parameter_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('parameter_items');
        Schema::dropIfExists ('parameters');
    }
}
