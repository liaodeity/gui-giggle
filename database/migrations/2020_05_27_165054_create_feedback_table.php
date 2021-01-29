<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('feedback', function (Blueprint $table) {
            $table->id ();
            $table->string ('name', 50)->default ('')->comment ('联系人名称');
            $table->string ('contact', 20)->default ('')->comment ('联系人方式');
            $table->text ('content')->comment ('反馈内容');
            $table->string ('reply_title', 200)->default ('')->comment ('解决标题');
            $table->text ('reply_content')->comment ('解决内容');
            $table->timestamp ('follow_at')->nullable ()->comment ('跟进时间');
            $table->timestamp ('finish_at')->nullable ()->comment ('完结时间');
            $table->tinyInteger ('progress')->default (2)->comment ('处理进度[1=已处理,2=待处理,3=处理中,4=已驳回]');
            $table->tinyInteger ('status')->default (0)->comment ('状态[1=显示,0=隐藏]');
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
        Schema::dropIfExists ('feedback');
    }
}
