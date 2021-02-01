<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 初始化系统数据库基础信息
     * @return void
     */
    public function run ()
    {
        $this->call (SystemSeeder::class);
        $this->call (MenuSeeder::class);
        $this->call (ConfigSeeder::class);
    }
}
