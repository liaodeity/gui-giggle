<?php

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class AttachmentAccess extends BaseModel
{
    protected $table = 'attachment_access';
    protected $fillable = ['attachment_id', 'access_id', 'access_type'];
}
