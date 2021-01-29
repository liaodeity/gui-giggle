<?php

namespace App\Addons\User\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends BaseModel
{
    protected $fillable = ['user_id','real_name','id_number','live_address','created_at','updated_at'];



}
