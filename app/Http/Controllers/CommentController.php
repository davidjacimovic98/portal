<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // create new comment
    public function store(Request $request) {
        $formFields = $request->validate([
            'body' => 'required',
            'news_id' => 'required|exists:news,id',
        ]);

        $formFields['user_id'] = auth()->id();

        Comment::create($formFields);

        return redirect()->back()->with('message', 'Comment added successfully.');
    }

    // delete comment
    public function destroy(Comment $comment) {
        // Make sure that logged in user is owner of comment
        if($comment->user_id != auth()->id()) {
            abort(403, 'Unauthorized action!');
        }
        
        $comment->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully!');
    }
}
