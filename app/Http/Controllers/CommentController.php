<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, Request $request)
    {
        $validated = $request->validate([
            'text' => ['required'],
            'user_id' => ['required'],
            'post_id' => ['required'],
        ]);

        if($validated) {
            $comment = Comment::create($validated);
            $html = View::make('components.partials.comments', ['comment' => $comment])->render();

            return response()->json($html);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Comment::find($id);
        $post->delete();

        return response()->json('Comment deleted');
    }
}
