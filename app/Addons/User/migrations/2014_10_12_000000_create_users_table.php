<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('user_no', 20)->default('')->comment('用户编号');
            $table->char('mobile', 20)->default('')->comment('用户手机号');
            $table->string('email', 100)->default('')->comment('用户邮箱');
            $table->string('nickname', 20)->default('')->comment('昵称');
            $table->date('birthday')->nullable()->comment('出生日期');
            $table->tinyInteger('gender')->default(0)->comment('性别[1=男,2=女]');
            $table->date('reg_date')->nullable()->comment('注册时间');
            $table->string('real_name', 20)->default('')->comment('真实姓名');
            $table->string('id_number', 18)->default('')->comment('身份证号');
            $table->string('live_address', 100)->default('')->comment('居住地址');
            $table->unsignedBigInteger('avatar_id')->default (0)->comment ('头像');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('user_members', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('user_id');
            $table->string('password', 128)->default('')->comment('密码');
            $table->tinyInteger('status')->default(0)->comment('会员状态[1=使用中,4=已禁用,5=注销]');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//外键
        });
        Schema::create('user_admins', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger('user_id')->nullable()->comment('所属用户');
            $table->string('username', 50)->default('')->comment('登录名称');
            $table->string('password', 128)->default('')->comment('密码');
            $table->tinyInteger('status')->default(0)->comment('状态[1=使用中,4=已禁用]');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_admins');
        Schema::drop('user_members');
        Schema::dropIfExists('users');
    }
}
