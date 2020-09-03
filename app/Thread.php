<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'topic',
        'body',
        'user_id',
        'channel_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
