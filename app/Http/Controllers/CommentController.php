<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $comment = $post->comments()->create([
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, $postId, $commentId)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::where('post_id', $postId)->find($commentId);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->update($request->all());
        return response()->json($comment);
    }

    public function destroy($postId, $commentId)
    {
        $comment = Comment::where('post_id', $postId)->find($commentId);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }

}
