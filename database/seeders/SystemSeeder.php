<?php
namespace Database\Seeders;
use App\Addons\User\Models\Admin;
use App\Addons\User\Models\User;
use App\Addons\User\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 系统初始化测试类
     * @return void
     */
    public function run ()
    {
        $password = Hash::make ('123456');
        $admin    = Admin::where ('username', 'admin')->first ();
        if ($admin) {
            $userId = $admin->user_id;
        } else {
            $user = User::create (['nickname'=>'admin']);
            $userId = $user->id;
            Admin::create (['username' => 'admin', 'user_id' => $userId, 'password' => $password, 'status' => 1]);
        }

        $token = '97c75167-930b-40da-a009-1103d724b60a';
        UserToken::where ('token', $token)->delete ();
        $expiredAt = Carbon::parse (now ())->addYear (1);//有效期
        UserToken::create (['type' => 'admin', 'user_id' => $userId, 'token' => $token, 'expired_at' => $expiredAt]);

        //Shop::create (['user_id' => $userId, 'status' => 1]);


    }
}
