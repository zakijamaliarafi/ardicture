<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikedPost extends Model
{
    use HasFactory;

    protected $table = 'user_liked_post';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public static function countLikedPostsByUserId($userId) {
        return self::where('user_id', $userId)->count();
    }
}