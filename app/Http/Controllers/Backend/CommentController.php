<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
     /**
     * Store a newly created comment.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Commentaire ajouté.');
    }

}
