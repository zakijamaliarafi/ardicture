<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }

    public static function findOrCreate($tagName)
    {
        // Check if the tag already exists
        $tag = self::where('tag', $tagName)->first();

        if ($tag) {
            // Return the existing tag
            return $tag;
        } else {
            // Create a new tag and return it
            $newTag = self::create(['tag' => $tagName]);
            return $newTag;
        }
    }
}
