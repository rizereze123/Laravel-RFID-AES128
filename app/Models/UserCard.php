<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    use HasFactory;

    protected $table = 'user_cards';

    protected $primaryKey = 'uid';
    
    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $guarded = [];

    protected $with = ['device'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function userLog()
    {
        return $this->hasMany(UserLog::class);
    }
}
