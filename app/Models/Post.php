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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public static function countPostsByUserId($userId)
    {
        return self::where('user_id', $userId)->count();
    }

    public static function getPostsByUserId($userId)
    {
        $posts = self::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        foreach ($posts as $post) {
            $user = $post->user;
            $post->userId = $user->id;
            $post->username = $user->username;
            $post->profile = $user->user_profile;
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }

    public static function getMorePostsByuser($userId)
    { // add $excludedPostId as parameter if using second post eloquent
        $posts = self::where('user_id', $userId)->orderBy('created_at', 'desc')->take(4)->get();
        // $posts = self::where('user_id', $userId)
        //             ->whereNotIn('id', [$excludedPostId])
        //             ->inRandomOrder()
        //             ->take(4)
        //             ->get();

        foreach ($posts as $post) {
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }

    public static function getRandomPosts($numberOfPost)
    {
        $posts = self::inRandomOrder()->take($numberOfPost)->get();

        foreach ($posts as $post) {
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }

    public static function getPosts($numberOfPost)
    {
        $posts = self::with('user')->orderBy('created_at', 'desc')->take($numberOfPost)->get();

        foreach ($posts as $post) {
            $user = $post->user;
            $post->userId = $user->id;
            $post->username = $user->username;
            $post->profile = $user->user_profile;
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }

    public static function getPostsByTag($tag)
    {
        $tag = Tag::where('tag', $tag)->first();

        if (!$tag) {
            return [];
        }

        $posts = $tag->posts()->with('user')->orderBy('created_at', 'desc')->take(20)->get();

        foreach ($posts as $post) {
            $user = $post->user;
            $post->userId = $user->id;
            $post->username = $user->username;
            $post->profile = $user->user_profile;
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }

    public static function getLikedPosts($userId)
    {
        $posts = self::whereIn('id', Like::where('user_id', $userId)->pluck('post_id'))->get();

        foreach ($posts as $post) {
            $user = $post->user;
            $post->userId = $user->id;
            $post->username = $user->username;
            $post->profile = $user->user_profile;
            $post->image = optional($post->images()->first())->image;
        }

        return $posts;
    }
}
