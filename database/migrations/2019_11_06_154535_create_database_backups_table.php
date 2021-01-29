<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDatabaseBackupsTable.
 */
class CreateDatabaseBackupsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('db_backups', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('user_id')->comment('备份人');
            $table->string('name', 100)->default('')->comment('备份名称');
            $table->string('path', 150)->default('')->comment('备份文件路径');
            $table->timestamp('start_at')->nullable()->comment('开始备份时间');
            $table->timestamp('end_at')->nullable()->comment('结束备份时间');
            $table->unsignedBigInteger('size')->default(0)->comment('数据压缩大小');
            $table->tinyInteger('status')->default(0)->comment('状态[1=已备份,2=备份中,4=备份失败]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('db_backups');
    }
}
