<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_fields', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('block_id')->comment ('视图块ID')->constrained ();
            $table->foreignId ('field_id')->comment ('字段ID')->constrained ();
            $table->string ('typeof_data',200)->default ('')->comment ('数据类型');
            $table->tinyInteger ('is_hide')->default (0)->comment ('是否隐藏字段');//
            $table->tinyInteger ('is_create')->default (1)->comment ('是否允许创建');//
            $table->tinyInteger ('is_quick_create')->default (1)->comment ('是否允许快速创建');//
            $table->tinyInteger ('is_edit')->default (1)->comment ('是否允许修改');//
            $table->tinyInteger ('is_view')->default (1)->comment ('是否允许查看');//
            $table->tinyInteger ('is_require')->default (0)->comment ('是否必填');//
            $table->tinyInteger ('is_foreign_key')->default (0)->comment ('是否关键外键字段');
            $table->tinyInteger ('ui_type')->default (1)->comment ('视图显示类型[1=文本,2=链接,3=邮箱,4=电话号码,5=复选框,6=文本区域,7=多选组合框,8=日期,9=时间,10=小数,11=整数,12=百分数,13=货币,14=选择列表]');//
            $table->smallInteger ('sort')->default (0)->comment ('排序');
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
        Schema::dropIfExists('block_fields');
    }
}
