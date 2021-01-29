<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMenusTable.
 */
class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('pid')->default(0)->comment('父ID');
            $table->string('menu_name',100)->default('')->unique ()->comment('菜单标识名称');
            $table->string('auth_name')->default('')->comment('权限名称');
            $table->tinyInteger('module')->default(0)->comment('所属模块[1=admin,2=agent]');
            $table->tinyInteger('type')->default(0)->comment('类型[1=菜单,2=权限,3=按钮]');
            $table->integer('sort')->default(99)->comment('排序');
            $table->string('route_url', 100)->default('')->comment('路由地址');
            $table->string('title', 50)->default('')->comment('菜单名称');
            $table->string('icon', 100)->default('')->comment('图标');
            $table->tinyInteger('status')->default(0)->comment('状态[1=显示,4=隐藏]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
