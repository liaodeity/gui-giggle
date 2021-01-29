<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('field_items', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('field_id')->constrained ()->cascadeOnDelete ();
            $table->string ('value',100)->default ('')->comment ('键值');
            $table->string ('label')->comment ('名称');
            $table->tinyInteger ('status')->default (1)->comment ('状态[1=正常,2=隐藏]');
            $table->string ('color', 50)->default ('')->comment ('颜色');
            $table->smallInteger ('sort')->default (99)->comment ('排序');
            $table->unique (['field_id', 'value']);
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
        Schema::dropIfExists ('field_items');
    }
}
