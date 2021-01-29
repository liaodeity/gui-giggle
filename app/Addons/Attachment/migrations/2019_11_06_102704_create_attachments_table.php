<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create ('attachments', function (Blueprint $table) {
            $table->id ();
            $table->uuid('uuid')->unique ()->comment ('附件唯一码');
            $table->string ('path', 200)->default ('')->comment ('路径');
            $table->string ('title', 100)->default ('')->comment ('名称');
            $table->char ('md5', 32)->default ('')->comment ('MD5值');
            $table->char ('sha1', 42)->default ('')->comment ('SHA1值');
            $table->string ('mine_type', 100)->default ('')->comment ('文件类型');
            $table->string ('suffix', 10)->default ('')->comment ('后缀名');
            $table->unsignedInteger ('size')->default (0)->comment ('附件大小byte');
            $table->bigInteger ('use_number')->default (0)->comment ('使用次数');
            $table->timestamp ('last_at')->nullable ()->comment ('最后使用时间');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=使用中,4=已禁用]');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('上传人');
            //$table->string ('access_type', 100)->default ('')->comment ('关联类型');
            $table->softDeletes ();
            $table->timestamps ();
        });
        Schema::create ('attachment_access', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('attachment_id');
            $table->morphs ('access');
            $table->timestamps ();
        });
        Schema::create ('attachment_clouds', function (Blueprint $table) {
            $table->id ();
            $table->tinyInteger ('type')->default (0)->comment ('云类型[1=阿里云,2=腾讯云,3=七牛云]');
            $table->string ('path')->comment ('')->comment ('云存储路径');
            $table->string ('url', 200)->default ('')->comment ('云地址');
            $table->timestamps ();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('attachment_access');
        Schema::dropIfExists ('attachment_clouds');
        Schema::dropIfExists ('attachments');
    }
}
