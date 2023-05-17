<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $datas = Post::with(['user', 'expert', 'category', 'likes'])->orderBy('created_at', 'desc')->get();

        $categories = Reference::where('name', 'category')->orderBy('code')->get();

        return view('module2.discussion-board', compact('datas', 'categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        Post::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Post Successfully Posted!");
    }
}
