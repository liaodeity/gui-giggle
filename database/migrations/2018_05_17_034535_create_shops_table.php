<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('shops', function (Blueprint $table) {

            $table->id ()->comment ('编号');//
            $table->unsignedBigInteger('user_id')->comment ('用户ID');//用户uid
            $table->string ('name', 100)->default ('')->comment ('商店名称');//
            $table->string ('desc', 200)->default ('')->comment ('商店描述');//
            $table->string ('address', 150)->default ('')->comment ('商店地址');
            $table->string ('region_ids', 100)->default ('')->comment ('商店所属区域');
            $table->string ('lat', 50)->default ('')->comment ('商店纬度');
            $table->string ('lng', 50)->default ('')->comment ('商店经度');
            $table->date ('join_date')->nullable ()->comment ('加盟日期');//
            $table->tinyInteger ('status')->default (0)->comment ('商店状态[1=正常,2=注销,3=关店]');//
            $table->timestamps ();
            $table->foreign ('user_id')->references ('id')->on ('users')->onDelete ('cascade');//用户外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('shops');
    }
}
