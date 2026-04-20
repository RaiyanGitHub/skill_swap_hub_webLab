<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'swap_request_id','from_user_id','to_user_id','rating','comment'
    ];
    public function fromUser()
    {
    return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
    return $this->belongsTo(User::class, 'to_user_id');
    }
}
