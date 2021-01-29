<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomViewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_view_fields', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('custom_view_id')->comment ('自定义视图ID')->constrained ()->cascadeOnDelete ();
            $table->foreignId ('field_id')->comment ('字段ID')->constrained ()->cascadeOnDelete ();
            $table->tinyInteger ('is_hide')->default (0)->comment ('是否隐藏');
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
        Schema::dropIfExists('custom_view_fields');
    }
}
