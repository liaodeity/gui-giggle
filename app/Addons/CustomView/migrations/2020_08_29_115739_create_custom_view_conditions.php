<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomViewConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_view_conditions', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('custom_view_id')->comment ('自定义视图ID')->constrained ()->cascadeOnDelete ();
            $table->foreignId ('field_id')->comment ('字段ID')->constrained ();
            $table->smallInteger ('group_type')->default (1)->comment ('分组');
            $table->string ('type',10)->default ('AND')->comment ('连接类型');
            $table->string ('comparator',20)->default ('')->comment ('比较类型');
            $table->string ('data_value')->nullable ()->comment ('内容');
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
        Schema::dropIfExists('custom_view_conditions');
    }
}
