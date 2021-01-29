<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('fields', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('tab_id')->comment ('表ID')->constrained ();
            $table->string ('tab_name', 100)->default ('')->comment ('表名称');//
            $table->string ('field_name', 100)->default ('')->comment ('字段名称');//
            $table->string ('title', 50)->default ('')->comment ('字段中文名');//
            $table->string ('type', 20)->default ('')->comment ('字段类型');//
            $table->unsignedBigInteger ('max_length')->default (255)->nullable ()->comment ('字段最大长度');//
            $table->string ('default_value', 200)->nullable ()->comment ('字段默认值');//
            $table->tinyInteger ('is_nullable')->default (0)->comment ('是否可为空[1=是,0=否]');
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
        Schema::dropIfExists ('fields');
    }
}
