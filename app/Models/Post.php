<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    public static function countPostsByUserId($userId)
    {
        return self::where('user_id', $userId)->count();
    }
}
