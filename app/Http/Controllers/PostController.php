<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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

        //$validatedData['user_id'] = auth()->user()->id;
        $validatedData['user_id'] = 1;

        $post = Post::create($validatedData);

        if ($request->file('images')) {


            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/post-images');
                $validated_image['image'] = 'storage/' . $imagePath;
                $validated_image['post_id'] = $post->id;
                $validated_image['order'] = 1;
                Image::create($validated_image);
            }
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = Post::where('post_id', $post)->first();
        return view('posts.detail', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
