<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('plugins', function (Blueprint $table) {
            $table->id ();
            $table->uuid('name')->default ('')->comment ('插件标识');
            $table->string ('version', 100)->default ('')->comment ('当前版本号');
            $table->string ('title', 100)->default ('')->comment ('插件名称');
            $table->string ('cover_img', 100)->default ('')->comment ('封面图片');
            $table->text ('content')->comment ('插件详情');
            $table->text ('depend')->comment ('依赖插件');
            $table->text ('file_tree')->comment ('插件文件树');
            $table->tinyInteger ('is_install')->default (0)->comment ('是否安装[1=是,0=否]');
            $table->tinyInteger ('is_update')->default (1)->comment ('是否更新[1=是,0=否]');
            $table->timestamp ('install_at')->nullable ()->comment ('安装时间');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('修改人');
            $table->softDeletes ();
            $table->timestamps ();
        });
        //插件支持功能标记
        Schema::create ('plugin_supports', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('plugin_id')->default (0)->comment ('插件标识');
            $table->string ('name', 100)->default ('')->comment ('支持标记名称');
            $table->tinyInteger ('status')->default (1)->comment ('状态[1=已启用,0=不支持,2=已暂停]');
            $table->timestamp ('stop_at')->nullable ()->comment ('暂停时间');
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
        Schema::dropIfExists ('plugin_supports');
        Schema::dropIfExists ('plugins');
    }
}
