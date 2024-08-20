<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    
    protected $table = 'devices';

    protected $primaryKey = 'uid';

    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $guarded = [];

    public function UserCard()
    {
        return $this->hasMany(UserCard::class);
    }

}
