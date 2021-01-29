<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('version_logs', function (Blueprint $table) {
            $table->id ();
            $table->uuid('version_name')->default ('')->comment ('版本标识');
            $table->string ('version', 100)->default ('')->comment ('版本号');
            $table->unsignedBigInteger('plugin_name')->default (0)->comment ('插件标识');
            $table->date ('release_date')->nullable ()->comment ('发布日期');
            $table->string ('title', 100)->default ('')->comment ('版本标题');
            $table->text ('content')->comment ('更新内容');
            $table->text ('file_tree')->comment ('更新文件树');
            $table->string ('before_version', 100)->comment ('更新前版本');
            $table->timestamp ('update_at')->nullable ()->comment ('更新时间');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=已更新,2=未更新,3=更新中,4=更新失败,5=不更新]');
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
        Schema::dropIfExists ('version_logs');
    }
}
