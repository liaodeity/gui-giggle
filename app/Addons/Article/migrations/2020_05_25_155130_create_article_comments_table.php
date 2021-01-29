<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('article_comments', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('article_id')->nullable ()->comment ('文章编号');
            $table->string ('author', 50)->default ('')->comment ('评论人');
            $table->string ('contact', 100)->default ('')->comment ('联系方式');
            $table->string ('content', 1000)->default ('')->comment ('评论内容');
            $table->ipAddress ('ip')->default ('')->comment ('IP地址');
            $table->unsignedBigInteger('user_id')->default (0)->comment ('用户ID');
            $table->string ('status')->default (0)->comment ('状态[1=显示,4=隐藏]');
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
        Schema::dropIfExists ('article_comments');
    }
}
