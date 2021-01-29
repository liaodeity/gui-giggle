<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id ();
            $table->string ('type',20)->default ('')->comment ('来源[admin=后台,pc=前台,web=前台,agent=代理商]');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('用户ID');
            $table->uuid('token')->comment ('认证Token');
            $table->timestamp ('expired_at')->nullable ()->comment ('过期时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tokens');
    }
}
