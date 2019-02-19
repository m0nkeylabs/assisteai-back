<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $table = 'threads';

    protected $fillable = [
        'rating',
        'comment',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static $rules = [
        'rating'       => 'required',
        'url' => 'required',
    ];

    /**
     * @param $movie
     * @throws \Exception
     */
    public static function verifyIfExists(Movie $movie)
    {
        $movies_count = self::where('user_id', '=', \Auth::user()->id)->whereHas('movie', function (\Eloquent $query) use ($movie) {
            $query->where('id', '=', $movie->id);
        })->count();

        if($movies_count > 0) {
            throw new \Exception('Esse filme já foi indicado por você.');
        }
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
