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
            'user_id' => auth()->user()->id,
            'ref_post_status_id' => Reference::where('name', 'post-status')->where('code', 1)->first()->id,
        ]);

        Post::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Post Successfully Posted!");
    }

    public function destroy($id)
    {
        Post::find($id)->delete();

        return response()->json(['success' => true]);
    }

    public function close($id)
    {
        Post::find($id)->update([
            'ref_post_status_id' => Reference::where('name', 'post-status')->where('code', 3)->first()->id
        ]);

        return response()->json(['success' => true]);
    }
}
