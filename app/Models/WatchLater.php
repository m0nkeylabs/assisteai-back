<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchLater extends Model
{
    public $incrementing = false;

    protected $table = 'watch_later';

    protected $fillable = [
        'movie_id',
        'user_id',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}