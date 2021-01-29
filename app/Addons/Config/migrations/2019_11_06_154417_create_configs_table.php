<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConfigsTable.
 */
class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id ();
            $table->tinyInteger('type')->default(0)->comment('配置类型[1=数字,2=字符串,3=数组,4=json]');
            $table->string('name', 50)->default('')->comment('配置名称')->unique();
            $table->string('title', 100)->default('')->comment('配置标题');
            $table->text('context')->comment('配置内容');
            $table->text('param_json')->comment('配置选项');
            $table->string('desc', 200)->default('')->comment('说明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('configs');
    }
}
