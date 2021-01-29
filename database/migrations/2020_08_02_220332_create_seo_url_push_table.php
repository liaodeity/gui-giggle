<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoUrlPushTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('seo_url_pushes', function (Blueprint $table) {
            $table->id ();
            $table->string ('url', 200)->default ('')->comment ('地址');
            $table->tinyInteger ('is_push')->default (0)->comment ('是否推送[1=已推送,0=未推送]');
            $table->timestamp ('push_at')->nullable ()->comment ('推送时间');
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
        Schema::dropIfExists ('seo_url_pushes');
    }
}
