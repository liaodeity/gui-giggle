<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAgentsTable.
 */
class CreateRoleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('role_infos', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger ('role_id')->default (0)->comment('角色id');
            $table->string ('name', 50)->default ('')->comment ('角色名称');
            $table->text ('desc')->comment ('角色说明');
            $table->text('role_value')->comment('权限ID');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=使用中,4=已禁用]');
            $table->unsignedBigInteger('user_id')->nullable()->comment('创建人');
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
        Schema::drop ('role_infos');
    }
}
