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
        // 'parent_id' => 'nullable|integer|exists:comments,id'
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

    // // Set id_comment_group based on whether parent_id is provided or not
    // if ($request->parent_id) {
    //     $parentComment = Comment::findOrFail($request->parent_id);
    //     $comment->id_comment_group = $parentComment->id_comment_group;
    // } else {
    //     $comment->id_comment_group = $newCommentGroup;
    // }
    
    $comment->id_comment_group = $newCommentGroup;
    $comment->save();
    $comment->user = Auth::user();

    // if ($request->parent_id) {
    //     return response()->json(['success' => true, 'message' => 'Reply added successfully.', 'reply' => $comment], 201);
    // }

    return response()->json(['success' => true, 'message' => 'Comment added successfully.', 'comment' => $comment], 201);
}


    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment->update(['comment' => $request->comment]);

        return response()->json(['success' => true, 'comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(['success' => true]);
    }

}
