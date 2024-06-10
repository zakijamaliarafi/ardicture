<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\PostTag;
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
        $tags = array('All', 'Anime', 'Art', 'Poster', 'Wallpaper');
        $posts = Post::getPosts(20);
        $animePosts = Post::getPostsByTag('anime');
        $artPosts = Post::getPostsByTag('art');
        $posterPosts = Post::getPostsByTag('poster');
        $wallpaperPosts = Post::getPostsByTag('wallpaper'); 

        return view('index', [
            'posts' => $posts,
            'animePosts' => $animePosts,
            'artPosts' => $artPosts,
            'posterPosts' => $posterPosts,
            'wallpaperPosts' => $wallpaperPosts,
            'tags' => $tags
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

        // Store Images
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

        // Store Tags
        $tags = $request->input('tags');
        $tagsArray = explode(',', $tags);
        foreach ($tagsArray as $newTag) {
            $tag = Tag::findOrCreate(strtolower(str_replace(' ', '_', $newTag)));
            $postTag = new PostTag;
            $postTag->post_id = $post->id;
            $postTag->tag_id = $tag->id;
            $postTag->save();
        }

        // return redirect()->route('posts.index');
        return redirect()->route('posts.show', ['post' => $post->id])->with('message', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        // Fetch the post with its images, comments, and the user of each comment
        $post = Post::with(['images', 'comments.user'])->find($post);

        if ($post === null) {
            abort(404);
        }

        // Prepare the images URLs
        $images = $post->images->map(function ($image) {
            return asset('storage/' . $image->image);
        });

        // Fetch the post's user and tags
        $user = $post->user;
        $tags = $post->tags()->orderBy('tag', 'asc')->get();

        // Fetch additional posts by the same user and some random posts
        $morePostsByUser = Post::getMorePostsByuser($user->id);
        $randomPost = Post::getRandomPosts(4);

        $comments = $post->comments;

        return view('posts.detail', [
            'post' => $post,
            'images' => $images,
            'user' => $user,
            'tags' => $tags,
            'morePosts' => $morePostsByUser,
            'randomPosts' => $randomPost,
            'comments' => $comments
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

        $orderedTags = $post->tags()->orderBy('tag', 'asc')->get();
        $tags = $orderedTags->pluck('tag')->map(function ($tag) {
            return ucfirst(str_replace('_', ' ', $tag));
        });

        return view('posts.edit', [
            'post' => $post,
            'tags' => $tags,
        ]);
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

        // Get the new tags from the request and process them
        $newTags = collect(explode(',', $request->input('tags')))->map(function ($tag) {
            return strtolower(str_replace(' ', '_', $tag));
        })->unique();

        // Get the existing tags from the database
        $existingTags = $post->tags->pluck('tag');

        // Determine tags to add and tags to remove
        $tagsToAdd = $newTags->diff($existingTags);
        $tagsToRemove = $existingTags->diff($newTags);

        // Add new tags
        foreach ($tagsToAdd as $newTag) {
            $tag = Tag::findOrCreate(strtolower(str_replace(' ', '_', $newTag)));
            $postTag = new PostTag;
            $postTag->post_id = $post->id;
            $postTag->tag_id = $tag->id;
            $postTag->save();
        }

        // Remove old tags
        foreach ($tagsToRemove as $oldTag) {
            $tag = Tag::where('tag', $oldTag)->first();
            if ($tag) {
                $post->tags()->detach($tag->id);
            }
        }

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
