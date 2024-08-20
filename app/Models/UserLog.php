<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Eiger Loading
    protected $with = ['userCard'];


    public function scopeFilterByUID($query, $user_card_uid)
    {
        $query->when(($user_card_uid) ?? false, function ($query, $user_card_uid) {
            return $query->where('user_card_uid', '=', $user_card_uid);
        });
    }

    public function scopeFilterByDate($query, $start_date, $end_date)
    {
        $query->when(($start_date && $end_date) ?? false, function ($query) use ($start_date, $end_date) {
            return $query->whereBetween('check_in_date', [$start_date, $end_date]);
        });
    }

    public function scopeFilterByTime($query, $time_in, $time_out)
    {
        $query->when(($time_in && $time_out) ?? false, function ($query) use ($time_in, $time_out) {
            return $query->where('time_in', '>=', $time_in)->where('time_out', '<=', $time_out);
        });
    }

    public function scopeFilterByDept($query, $room)
    {
        $query->when(($room) ?? false, function ($query, $room) {
            return $query->whereHas('UserCard', function ($query) use ($room) {
                $query->where('device_uid', '=', $room);
            });
        });
    }

    /**
     * Relations
     * */
    public function UserCard()
    {
        return $this->belongsTo(UserCard::class);
    }
}
