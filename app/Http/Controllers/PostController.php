<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('index', ['posts' => Post::with('categories', 'user', 'comments')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        if ($validated) {
            $validated['user_id'] = Auth::id();
            $post = Post::create($validated);
            $categories = $request->input('categories');

            if($categories) {
                $post->categories()->attach($categories);
            }

            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with('categories')->find($id);
        $postCatIds = array_map(function($cat) {
            return $cat['id'];
        }, $post->categories->toArray());

        return view('edit', [
            'post' => $post,
            'categories' => Category::all(),
            'postCatIds' => $postCatIds
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        if ($validated) {
            $post = Post::find($id);
            $post->update($validated);
            $post->categories()->detach();
            $categories = $request->input('categories');
            $post->categories()->attach($categories);

            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json('Post deleted');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search' => ['required']
        ]);

        if($validated) {
            $posts = Post::where('title', 'LIKE', '%' . $request->input('search') . '%')
                ->orWhere('content', 'LIKE', '%' . $request->input('search') . '%')
                ->with('categories', 'user', 'comments')->get();
            
                return view('index', ['posts' => $posts]);
        }
        
        
    }
}
