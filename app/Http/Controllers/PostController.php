<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('posts.index', [
            'posts' => Post::all(),
            'images' => Image::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|max:255',
        ]);

        $validatedImage = $request->validate([
            'images' => 'required|max:10',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $post = Post::create($validatedData);

        if ($request->file('images')) {
            $order = 1;
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('post-images', 'public');
                $validated_image['image'] = $imagePath;
                $validated_image['post_id'] = $post->id;
                $validated_image['order'] = $order++;
                Image::create($validated_image);
            }
        }
        // return redirect()->route('posts.index');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = Post::with('images')->find($post);

        if ($post === null) {
            abort(404);
        }

        $images = $post->images->map(function ($image) {
        return asset('storage/' . $image->image);
        });

        $user = $post->user;

        $morePostsByUser = Post::getMorePostsByuser($user->id);

        $randomPost = Post::getRandomPosts(4);

        return view('posts.detail', [
            'post' => $post,
            'images' => $images,
            'user' => $user,
            'morePosts' => $morePostsByUser,
            'randomPosts' => $randomPost
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Make sure logged in user is owner
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Make sure logged in user is owner
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $validatedData = $request->validate([
            'description' => 'required|max:255',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // save id user
        $userId = $post->user_id;

        // Make sure logged in user is owner or admin
        if($userId != auth()->id()) {
            if(auth()->user()->role != 'admin'){
                abort(403, 'Unauthorized Action');
            }
        }

        // Retrieve images associated with the post
        $images = DB::table('images')->where('post_id', $post->id)->get();

        // Delete each image file from storage
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete images associated with the post
        DB::table('images')->where('post_id', $post->id)->delete();

        // Delete the post
        $post->delete();

        return redirect()->route('users.profile', ['user' => $userId]);
    }
}
