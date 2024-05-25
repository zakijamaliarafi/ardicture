<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\PostTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create()
    {
        return view('tags.create', []);
    }


    public function store(Request $request){
        // Modify the tag value before validation
        $request->merge([
            'tag' => strtolower(str_replace(' ', '_', $request->input('tag')))
        ]);

        // Validate the modified data
        $validated = $request->validate([
            'tag' => 'required|max:255',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $tag = Tag::findOrCreate($request->tag);

        // Check if the record already exists
        $exists = PostTag::where('post_id', $validated['post_id'])
                         ->where('tag_id', $tag->id)
                         ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Tag already exists']);
        }

        // Create the new record
        $postTag = new PostTag;
        $postTag->post_id = $validated['post_id'];
        $postTag->tag_id = $tag->id;
        $postTag->save();

        return response()->json(['success' => true, 'message' => 'Tag added successfully', 'tag' => $tag], 201);
    }

    public function show($tagName) {
        $tag = Tag::where('tag', $tagName)->first();

        if (!$tag) {
            // If the tag doesn't exist, return a 404 response
            abort(404, 'Tag not found');
        }

        $posts = $tag->posts()->with('user')->orderBy('created_at', 'desc')->paginate(20);

        foreach ($posts as $post) {
            $user = $post->user;
            $post->userId = $user->id;
            $post->username = $user->username;
            $post->profile = $user->user_profile;
            $post->image = optional($post->images()->first())->image;
        }

        return view('posts.index', ['posts' => $posts, 'tag' => $tag]);
    }
}
