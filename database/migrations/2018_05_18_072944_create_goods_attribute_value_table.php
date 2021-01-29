<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attribute_value', function (Blueprint $table) {

            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('attribute_id')->comment ('属性名ID');//
            $table->string('attribute_value',100)->comment ('属性值');//
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
        Schema::dropIfExists('goods_attribute_value');
    }
}
