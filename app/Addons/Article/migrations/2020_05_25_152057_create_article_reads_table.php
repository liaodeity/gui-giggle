<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('article_reads', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('article_id')->comment ('文章编号');
            $table->timestamp ('view_at')->nullable ()->comment ('浏览时间');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('浏览人');
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
        Schema::dropIfExists ('article_reads');
    }
}
