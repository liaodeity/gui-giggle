<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSerialNumberTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create ('serial_numbers', function (Blueprint $table) {
            $table->id ();
            $table->unsignedBigInteger ('serial_no')->default (0)->comment ('流水号')->unique ();
            $table->string ('prefix', 50)->default ('')->comment ('编号前缀');
            $table->morphs ('access');
            //$table->unsignedBigInteger ('access_id')->default (0)->comment ('关联ID');
            //$table->string ('access_type', 100)->default ('')->comment ('关联类型');
            $table->unsignedBigInteger('user_id')->nullable ()->comment ('所属用户');
            $table->timestamps ();
        });
        //$time = time ();
        //DB::statement ("ALTER TABLE " . DB::getConfig ('prefix') . "serial_numbers AUTO_INCREMENT = $time;");
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('serial_numbers');
    }
}
