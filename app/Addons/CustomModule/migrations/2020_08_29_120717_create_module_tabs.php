<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_tabs', function (Blueprint $table) {
            $table->id ();
            $table->foreignId ('module_id')->constrained ()->cascadeOnDelete ();
            //$table->foreignId ('tab_id')->comment ('表ID')->constrained ();
            //$table->foreignId ('foreign_tab_id')->comment ('外键表ID')->constrained ('tabs');
            $table->string ('for_name')->default ('')->comment ('外键表');
            $table->string ('for_col_name')->default ('')->comment ('外键字段表');
            $table->string ('joiner')->default ('')->comment ('连接符');
            $table->string ('ref_col_name')->default ('')->comment ('参考表');
            $table->string ('ref_name')->default ('')->comment ('参考字段表');
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
        Schema::dropIfExists('module_tabs');
    }
}
