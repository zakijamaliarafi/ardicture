<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        // Retrieve the latest id_comment_group for the given post_id and increment it by one
        $latestCommentGroup = Comment::where('post_id', $request->post_id)
        ->orderBy('id_comment_group', 'desc')
        ->value('id_comment_group');
        $newCommentGroup = $latestCommentGroup ? $latestCommentGroup + 1 : 1;

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->id_comment_group = $newCommentGroup;
        $comment->save();

        $comment->user = Auth::user();

        return response()->json(['success' => true, 'message' => 'Comment added successfully.', 'comment' => $comment], 201);
    }

}
